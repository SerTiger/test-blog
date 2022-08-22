<template>
    <a @click="signature()" href="#" class="btn-blue">
        <slot></slot>
    </a>
</template>

<script>
    export default {
        name: "Sign",
        mounted: function () {
            this.login = false;
        },
        props: {
            'link': { default: undefined }
        },
        data(){
            return [
                'loading',
                'signature',
                'login',
                'message',
                'address'
            ]
        },
        methods: {
            signature() {
                this.loading = true;

                if(this.login) {
                    if(this.link) window.location.href = this.link;
                    return false;
                }

                const web3 = new Web3(window.ethereum);
                // Fetch nonce
                const nonce = axios.get('/metamask/ethereum/signature');
                // Get wallet address
                const address = web3.eth.requestAccounts();

                axios.all([nonce, address]).then(axios.spread((...responses) => {

                    this.message = responses[0].data;
                    this.address = responses[1][0];
                    this.chainId = window.ethereum.networkVersion;

                    // Sign message
                    web3.eth.personal.sign(this.message, this.address)
                        .then((response)=>{
                            this.signature = response;

                            axios.post('/metamask/ethereum/authenticate', {
                                'address': this.address,
                                'signature': this.signature,
                                'chainId': this.chainId,
                            }).then(() => {
                                this.login = true;
                                if(this.link) window.location.href = this.link;
                            }).catch((e)=>{
                                alert(e.message);
                                this.loading = false;
                            })
                        })
                        .catch(errors => {
                            // react on errors.
                            this.loading = false;
                        });
                })).catch(errors => {
                    // react on errors.
                    this.loading = false;
                })

            },
        }
    }
</script>

<style scoped>

</style>
