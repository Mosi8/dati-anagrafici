<template>
    <div class="container form-personale">
            <h3 class="my-5">Modulo di invio dei dati anagrafici</h3>
            <form @submit.prevent="sendMessage()" class="form">
                <span>Nome<sup>*</sup></span>
                <input type="text" id="sender_name" v-model="formData.sender_name" class="campi">
                <span>Cognome<sup>*</sup></span>
                <input type="text" id="sender_surname" v-model="formData.sender_surname" class="campi">
                <span>E-Mail<sup>*</sup></span>
                <input type="email" id="sender_email" v-model="formData.sender_email" class="campi">

                <div v-if="formErrors">
                    <ul>
                        <li v-for="(error, index) in formErrors" :key="index">
                            {{error[0]}}
                        </li>
                    </ul>
                </div>

                <button type="submit" class="button">Invia</button>
                <div v-show="commentSent">
                    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                        <strong>Dati Anagrafici inviati!</strong>
                        <hr>
                        <p class="mb-0">Grazie, i tuoi dati anagrafici sono stati inviati correttamente.</p>
                    </div>
                </div>
            </form>
        </div>

</template>

<script>
export default {
    name: 'Form',
    data (){
        return {
            formData: {
                    sender_name: "",
                    sender_surname: "",
                    sender_email: ""
                },
                commentSent: false,
                formErrors: {}
        }
    },
    methods: {
        sendMessage() {
            axios
            .post(`/api/messages/`, this.formData)
            .then((response)=> {
                this.formData.sender_name = "";
                this.formData.sender_email = "";
                this.formData.sender_surname = "";
                this.commentSent = true; 
            })
            .catch( (error) => {
                this.formErrors = error.response.data.errors;
                console.log(error.response);
            })
        },
    }
}
</script>

<style lang="scss" scoped>

.form-personale {

    margin: 30px;

        span {
            font-size: 1rem; 
            a {
                text-decoration: none;
                color: #0b1d6f;
                font-weight: 500;
            }
        }

        .form {
            margin-bottom: 60px;
            span{
                font-size: 0.8rem;
                margin: 10px 0;
                display: inline-block;
                color: #666666;
                sup {
                    color: #0b1d6f;
                }
            }
            .campi  {
                display: block;
                width: 75%;
                height: 40px;
                margin-bottom: 15px;
                border: solid 1px #e1e1e1;
                border-radius: 3px;
                background-color: #f8f8f8;
                color: #919191;
            }

            button {
                background-color: #0b1d6f;
                padding: 12px 50px;
                border-radius: 2px;
                font-size: 0.9rem;
                border: none;
                color: #fff;
            }
        }
    }

</style>