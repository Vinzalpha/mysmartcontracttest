pragma solidity ^0.5.8;

contract EtherWallet {
    address public owner;
    
    constructor() public {
        owner = msg.sender;
    }
    
    function deposit() payable public {}
    
    function balanceOf() public view returns(uint) {
        return address(this).balance;
    }
    
    function withdraw(address payable _to) public {
        require(_to != address(0), 'You should not send ether to a empty address');
        // Seul le propriétaire du smart contract peut retirer de l'argent
        require(msg.sender == owner, 'Seulement le propriétaire du smart contract');
        _to.transfer(address(this).balance);
    }
}