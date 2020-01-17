const EtherWallet = artifacts.require("EtherWallet");

let etherwallet;

contract('EtherWallet', ([owner, voleur]) => {
    describe('Le smart contract est déployé', () => {
        before(async () => {
            etherwallet = await EtherWallet.deployed();
        })

        it('Le smart contract a été déployé avec succès', async () => {
            const address = await etherwallet.address;
            assert(address != undefined);
            assert.notEqual(address, '0x0');
            console.log(address);
        })

        it('le dépôt fonctionne bien', async () => {
            await etherwallet.deposit({from: owner, value: web3.utils.toWei('1', 'Ether')});
            result = await etherwallet.balanceOf();
            console.log(result);
            console.log(web3.utils.toWei('1', 'Ether'));
            assert.equal(result, web3.utils.toWei('1', 'Ether'));
        })

        it('withdraw fonctionne bien', async () => {
            let initialBalanceSmartContract;
            initialBalanceSmartContract = await etherwallet.balanceOf();
            initialBalanceSmartContract = new web3.utils.toBN(initialBalanceSmartContract);
            await etherwallet.withdraw(owner, {from: owner})
            let finalBalanceSmartContract;
            finalBalanceSmartContract = await etherwallet.balanceOf();
            finalBalanceSmartContract = new web3.utils.toBN(finalBalanceSmartContract);
            const result = initialBalanceSmartContract.sub(finalBalanceSmartContract);

            assert.equal(result, web3.utils.toWei('1', 'Ether'));
            

        })

        it('withdraw ne doit pas fonctionner si msg.sender !== owner', async () => {
            try{
                await etherwallet.withdraw(voleur, {from: voleur});
            }
            catch(error){
                assert(error.message.includes('Seulement le propriétaire du smart contract'));
                return;
            } assert(false);
        })

        it('withdraw ne doit pas fonctionner si _to == 0x0...', async () => {
            try{
                await etherwallet.withdraw("0x0", {from: owner});
            }
            catch(error){
                assert(error.message.includes('You should not send ether to a empty address'));
                return;
            } assert(false);
        })

    })
    
})