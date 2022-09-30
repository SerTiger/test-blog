import Web3 from 'web3/dist/web3.min.js'
window.Web3 = Web3;

window.nonce = undefined;
window.personal_sign = function(callback) {
    ;
}

var toggle_sign_backdrop = function(status) {
    if(status === true) $('#sign_backdrop').show()
    else if(status === false) $('#sign_backdrop').hide()
    else $('#sign_backdrop').toggle();
}

if(window.ethereum) {
    window.ethereum.on('accountsChanged', function (accounts) {
        let address = accounts[0];

        // Sign message
        $.ajax({
            type: 'POST',
            url: '/metamask/ethereum/switch',
            cache: false,
            data: {
                'address': address,
                'chainId': window.ethereum.networkVersion
            },
        }).done(function (response) {
            window.location.reload(true);
        }).fail(function (error) {
            console.log(error)
        });

    });

    window.ethereum.on('chainChanged', function (chainId) {
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
            console.log(error)
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
            console.log(error)
            toggle_sign_backdrop(false);
        });
    }

    window.transaction_sign = function(transactions, store_uri) {
        toggle_sign_backdrop(true);

        var batch = [];
        var amount = 0;

        ['main','fee'].forEach(type=>{
            let transaction = transactions[type];

            batch.push({
                from: transaction.from,
                to: transaction.to,
                value: '0x' + ((amount * 1000000000000000000).toString(16)),
            });
            amount += transaction.amount;
        });

        window.ethereum
            .request({
                method: 'eth_sendTransaction',
                params: batch,
            })
            .then((txHash) => {
                if (txHash) {
                    $.ajax({
                        url: store_uri,
                        type: 'POST',
                        data: {
                            txHash: txHash,
                            amount: amount,
                            scope: transactions['main'].scope,
                            address: transactions['main'].to
                        },
                        success: function (response) {
                            // reload page after success
                            if(response.link) {
                                window.location.href = response.link;
                            } else {
                                window.location.reload();
                            }
                        }
                    });
                } else {
                    console.log("Something went wrong. Please try again");
                }
                toggle_sign_backdrop(false);
            })
            .catch((error) => {
                toggle_sign_backdrop(false);
            });

    }
}
