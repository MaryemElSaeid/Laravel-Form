<template>
    <form @submit.prevent="handleSubmit" >

        <div class="success" v-if="savingSuccessful"> 
             {{ savingSuccessful }} 
        </div>

        <label>Name:</label>
        <input type="text" required v-model="user.name" v-on:click="onmouseover">
        <div v-if="nameError" class="error">
            {{ nameError }}
        </div>

        <label>Email:</label>
        <input type="email" required v-model="user.email" v-on:click="onmouseover">

        <label>Brand Name:</label>
        <input type="text" required v-model="user.brand_name" v-on:click="onmouseover">
        <div v-if="brandError" class="error">
            {{ brandError }}
        </div>
        
        <div class="cr" id="demo">
            <input type="checkbox" v-model="user.cr" v-on:click="show = !show" v-on:change="onmouseover">
            <label>Upload CR</label>
             <transition name="fade">
                <div v-if="show">
                  <div class="form-group">
                    <input type="file" class="form-control-file" v-on:change="onChange" id="exampleFormControlFile1"  accept=".pdf">
                  </div>
                </div>
            </transition>
        </div>

        <div class="sumbit">
            <button>Submit</button>
        </div>


    </form>

</template>

<script>
export default {
    data: function() {
        return {
            user: {
                name:'',
                email: '',
                brand_name:'',
                cr: null,
            },
            savingSuccessful:'',
            show: false,
            text: '',
            nameError:'' ,
            brandError:'' ,

        }
    },

    methods: {

        onmouseover() {
            this.savingSuccessful = ''
            // console.log('testttt');
        },


        onChange(e) {
                this.user.cr = e.target.files[0];
        },
               //write error or success msg depending on server respond
               handleSubmit() {
                //try to exit code if an error msg appeared
                this.nameError = this.user.name.length > 5 
                ? '' : 'Name must be at least 6 chars long' 

                this.brandError = this.user.brand_name.length > 5 
                ? '' : 'Brand Name must be at least 6 chars long' 

                // // if(this.nameError == '' && this.brandError == '') {

                // //     this.savingSuccessful = 'Your form has been submitted successfuly'
                // // }
                // console.log(this.user);
                
                // axios.post('api/form',{
                //    user: this.user
                // })
            //    console.log(this.user.id);

              
            //    function checkoncr() {

                //  console.log(this.user.cr);

                    if(this.user.cr == null || this.user.cr == true ){
                        var data = '';
                    //    console.log(data);
                    //    console.log('file not uploaded')
                    //    console.log(this.user.cr);
                } else {
                        var data = new FormData();
                        data.append('cr', this.user.cr);
                        // console.log(data);
                        // console.log(this.user.cr);           
                }
                   
            //    }

               

            //     console.log(data);
           
               axios({
                   
                    method: 'post',
                    url: 'api/form',
                    headers: { 'Content-Type': 'application/json' },
                    params: { 
                      name: this.user.name,
                      email: this.user.email,
                      brand_name: this.user.brand_name,                  
                       },
                    data
             })

             .then(response =>{
                 if(response.status == 201) {
                    //  console.log(response.data.data.id);
                        this.savingSuccessful = 'Submitted Successfully, Please Check your email'
                        this.user.name='';
                        this.user.email='';
                        this.user.brand_name='';
                        this.show = false ;
                        this.user.cr = null ;

                            axios({
                                    method: 'get',
                                    url: 'email/'+response.data.data.id,
                                    headers: { 'Content-Type': 'application/json' },
                                    params: { 
                                    name: this.user.id,               
                                    },
                                    
                            })

                            .then(response =>{
                                if(response.status == 200) {
                                        // this.savingSuccessful = 'Submitted Successfully, Please Check your email'
                                        console.log('email sent successfully');
                                }
                            })
                            .catch(error => {
                                console.log(error);
                            })
                        
                 }
             })
             .catch(error => {
                 console.log(error);
             })  
        },//end handle method

    }//method

}


</script>

<style scoped>

 form {
    max-width: 420px;
    margin: 30px auto;
    background: white;
    text-align: left;
    padding: 40px;
    border-radius: 10px;
 }

 label {
     color: #aaa;
     display: inline-block;
     margin: 25px 0 15px;
     font-size: 0.6em;
     text-transform: uppercase;
     letter-spacing: 1px;
     font-weight: bold;
 }

 input, select{
     display: block;
     width: 400px;
     padding: 10px 20px;
     box-sizing: border-box;
     border: none;
     border-bottom: 1px solid #ddd;
     color: #555;
 }

 input[type="checkbox"] {
     display: inline-block;
     width: 16px;
     margin: 0 10px 0 0;
     position: relative;
     top: 2px;
 }

 button {
     background: black;
     border:0;
     padding: 10px 20px;
     margin-top: 20px;
     margin-left: 150px;
     color: white;
     border-radius: 20px;
 }

 .submit {
     text-align: center;
 }

 .success {
     color:white;
     font-size: 0.8em;
     font-weight: bold;
     background: green;
     border:0;
     padding: 10px 20px;
     border-radius: 20px;
     text-align: center;
 }

  .error {
     color:red;
     font-size: 0.8em;
     font-weight: bold;
     padding: 10px 20px;
 }

 .fade-enter-active, .fade-leave-active {
   transition: opacity .5s;
  }
 .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
   opacity: 0;
 }

</style>
