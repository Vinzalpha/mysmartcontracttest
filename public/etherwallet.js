let web3 = null;
let etherwallet = null;

const initWeb3 = () => {
  return new Promise((resolve, reject) => {
    if (typeof window.ethereum !== 'undefined') {
      const web3 = new Web3(window.ethereum);
      window.ethereum.enable()
        .then(() => {
          resolve(
            new Web3(window.ethereum)
          );
        })
        .catch(e => {
          reject(e);
        });
      return;
    }
    if (typeof window.web3 !== 'undefined') {
      return resolve(
        new Web3(window.web3.currentProvider)
      );
    }
    resolve(new Web3('http://localhost:7545'));
  });
};

const contractABI = [
  {
    "constant": true,
    "inputs": [],
    "name": "owner",
    "outputs": [
      {
        "name": "",
        "type": "address"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "constructor"
  },
  {
    "constant": false,
    "inputs": [],
    "name": "deposit",
    "outputs": [],
    "payable": true,
    "stateMutability": "payable",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [],
    "name": "balanceOf",
    "outputs": [
      {
        "name": "",
        "type": "uint256"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": false,
    "inputs": [
      {
        "name": "_to",
        "type": "address"
      }
    ],
    "name": "withdraw",
    "outputs": [],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "function"
  }
];
// const contractAddress = "0x0087DfE7Bf2cb07ecEe8e59521F81D153216AA69"; // Ganache
const contractAddress = "0x035E8C3A30dE92766A8685278F2bdF8372fA3D46"; // Mainnet
const initContract = () => {
  return new web3.eth.Contract(contractABI, contractAddress);
}

const initApp = () => {
  $contractAddress = document.getElementById('contractAddress');
  $contractAddress1 = document.getElementById('contractAddress1');
  $contractAddress2 = document.getElementById('contractAddress2');
  $contractAddress3 = document.getElementById('contractAddress3');
  $ownerAddress = document.getElementById('ownerAddress');

  $contractAddress.innerHTML = contractAddress;
  $contractAddress1.innerHTML = contractAddress;
  $contractAddress2.innerHTML = contractAddress;
  $contractAddress3.innerHTML = contractAddress;

  let owner = null;
  etherwallet.methods
    .owner()
    .call()
    .then(_owner => {
      owner = _owner;
      console.log(owner);
      $ownerAddress.innerHTML = owner;
    })

  $deposit = document.getElementById('deposit');
  $depositResult = document.getElementById('deposit-result');
  $balanceOf = document.getElementById('balanceOf');
  $balanceOfResult = document.getElementById('balanceOf-result');
  $withdraw = document.getElementById('withdraw');
  $withdrawResult = document.getElementById('withdraw-result');

  let accounts = [];
  web3.eth.getAccounts()
    .then(_accounts => {
      accounts = _accounts;
    })

  $deposit.addEventListener('submit', event => {
    event.preventDefault();
    let quantité;
    // quantité = event.target.elements[0].value;
    quantité = web3.utils.toWei(event.target.elements[0].value, 'Ether');
    etherwallet.methods
      .deposit()
      .send({from: accounts[0], value: quantité})
      .then(() => {
        $depositResult.innerHTML = `${web3.utils.fromWei(quantité, 'Ether')} ether a été déposé dans le smart contract`;
      })
  })

  $balanceOf.addEventListener('submit', event => {
    event.preventDefault();
    etherwallet.methods
      .balanceOf()
      .call()
      .then(result => {
        $balanceOfResult.innerHTML = `Il y a ${result} wei ou ${web3.utils.fromWei(result, 'Ether')} ether dans le smart contract`
      })
  })

  $withdraw.addEventListener('submit', event => {
    event.preventDefault();
      if(event.target.elements[0].value != ""){
        const address = event.target.elements[0].value;
        etherwallet.methods
      .withdraw(address)
      .send({from: accounts[0]})
      .then(() => {
        $withdrawResult.innerHTML = `L'argent a été retiré depuis le smart contract`
      })
      } else {
        $withdrawResult.innerHTML = `L'adresse renseigné ne doit pas être nulle`
      }
  })
}

document.addEventListener('DOMContentLoaded', () => {
  initWeb3()
    .then(_web3 => {
      web3 = _web3;
      etherwallet = initContract();
      initApp();
    })
    .catch(error => console.log(error.message));
})