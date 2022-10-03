import Web3 from 'web3/dist/web3.min.js'
window.Web3 = Web3;

window.nonce = undefined;
window.switching = false;

var toggle_sign_backdrop = function(status) {
    if(status === true) $('#sign_backdrop').show()
    else if(status === false) $('#sign_backdrop').hide()
    else $('#sign_backdrop').toggle();

    window.switching=false;
}

if(window.ethereum) {
    window.ethereum.on('accountsChanged', function (accounts) {
        if(window.switching) return;

        let address = accounts[0];

        // Sign message
        $.ajax({
            type: 'POST',
            url: '/metamask/ethereum/switch',
            cache: false,
            data: {
                'address': address,
                'currency': window.ethereum.networkVersion,
                'chainId': window.ethereum.networkVersion
            },
        }).done(function (response) {
            window.location.reload(true);
        }).fail(function (error) {
            alert2(JSON.stringify(error));
        });

    });

    window.ethereum.on('chainChanged', function (chainId) {
        if(window.switching) return;

        let address = window.ethereum.selectedAddress;
        // Sign message
        $.ajax({
            type: 'POST',
            url: '/metamask/ethereum/switch',
            cache: false,
            data: {
                'address': address,
                'chainId': chainId
            },
        }).done(function (response) {
            window.location.reload(true);
        }).fail(function (error) {
            alert2(JSON.stringify(error));
        });

    });

    window.personal_sign = function(callback) {
        toggle_sign_backdrop(true);

        // Sign message
        $.ajax({
            type: 'GET',
            url: '/metamask/ethereum/sign',
            cache: false,
        }).done(function (nonce_msg) {
            const web3 = new Web3(window.ethereum);

            web3.eth.personal.sign(
                nonce_msg,
                window.ethereum.selectedAddress,
                '',
                function(response) {
                    toggle_sign_backdrop(false);
                }
            )
            .then(function(response) {
                window.nonce = response;

                if ({}.toString.call(callback) === '[object Function]') callback();

                toggle_sign_backdrop(false);
            });

        }).fail(function (error) {
            alert2(error)
            toggle_sign_backdrop(false);
        });
    }

    function txSign(transactions, store_uri){
        let need_confirm = transactions.length;
        let link = undefined;

        ['fee','main'].forEach(type=>{
            let transaction = transactions[type];

            window.ethereum
                .request({
                    method: 'eth_sendTransaction',
                    params: [{
                        from: transaction.from,
                        to: transaction.to,
                        value: '0x' + ((transaction.amount * 1000000000000000000).toString(16)),
                    }],
                })
                .then((txHash) => {
                    if (txHash) {
                        $.ajax({
                            url: store_uri,
                            type: 'POST',
                            data: {
                                txHash: txHash,
                                amount: transaction.amount,
                                scope: transaction.scope,
                                type: type,
                                address: transaction.to
                            },
                            success: function (response) {

                                if (response.link) {
                                    link = response.link
                                }
                                need_confirm--;

                                if (need_confirm === 0) { // reload page after success
                                    if (link) {
                                        window.location.href = link;
                                    } else {
                                        window.location.reload();
                                    }
                                }
                            }
                        }).fail(function (error) {
                            toggle_sign_backdrop(false);
                        });
                    } else {
                        alert2("Something went wrong. Please try again");
                    }
                    need_confirm--;
                    if (need_confirm === 0) toggle_sign_backdrop(false);
                })
                .catch((error) => {
                    need_confirm--;
                    if (need_confirm === 0) toggle_sign_backdrop(false);
                });

        });
    }

    window.transaction_sign = function(transactions, store_uri) {
        toggle_sign_backdrop(true);

        try {
            let txChainId = '0x'+transactions['main'].chainId;
            if(window.ethereum.networkVersion !== txChainId ) {
                window.switching = true;
                window.ethereum
                    .request({
                        method: 'wallet_switchEthereumChain',
                        params: [{chainId: '0x' + transactions['main'].chainId}],
                    }).then(() => {
                        window.switching = false;
                        txSign(transactions, store_uri);
                    });
            } else {
                txSign(transactions, store_uri);
            }
        } catch (switchError) {
            alert2("Something went wrong. Please try again");
        }

        return;
    }
}