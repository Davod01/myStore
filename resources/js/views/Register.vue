<template>
  <div class="register-container">
  <div id="register-form">

    <p v-if="errors.length">
        <b>Please correct the following error(s):</b>
        <ul>
        <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>
    </p>
  <input id="userName" v-model="userName" type="text" min="3" max="30" placeholder="نام">

  <input id="email" v-model="email" type="email" name="email" placeholder="ایمیل">

  <input id="password" v-model="password" type="password" name="password" placeholder="رمز عبور">

  <input id="password_confirmation" v-model="passwordConfirm" type="password" name="password_confirmation" placeholder="رمز عبور">

  <input type="submit" value="Submit" v-on:click="Register()">

    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            userName: '',
            email: '',
            password: '',
            passwordConfirm: '',
            success: false
        }
    },
    methods: {
        Register() {
            this.$auth.register({
                data: {
                userName: this.userName,
                email: this.email,
                password: this.password,
                password_confirmation  : this.password_confirmation
                },
                success: function() {
                    this.success = true;
                    this.$router.push({name: 'login', params: {successRegistrationRedirect: true}});
                },
                error: function(res) {
                    this.errors = res;
                    console.log(res);
                }
            })
        }
    }
}
</script>

<style>

.register-container{
  width: 100%;
  height: 100vh;
  text-align: center; 
  background: #009FFF;  /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #ec2F4B, #009FFF);  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #ec2F4B, #009FFF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
;
  display: flex;
  align-items: center;
  justify-content: center;
}
#register-form {
  width:400px;
  height: 400px;
  background-color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
#register-form input{
  margin: 10px 0;
  font-size: 25px;
}

</style>