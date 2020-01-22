<template>
  <div class="login-container">
    <div id="login-form">

    <p v-if="errors.length">
        <b>Please correct the following error(s):</b>
        <ul>
        <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>
    </p>

    <input id="email" v-model="email" type="email" name="email" placeholder="ایمیل">

    <input id="password" v-model="password" type="password" name="password" placeholder="رمز عبور">

    <input type="submit" value="Submit" v-on:click="login()">

    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      errors: [],
      email: '',
      password:'',
      errors: [],
      success: false
    }
        
  },
  methods: {
    login() {
        // get the redirect object
        var redirect = this.$auth.redirect()
        var app = this
        this.$auth.login({
          params: {
            email: app.email,
            password: app.password
          },
          success: function() {
            // handle redirection
            const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 1 ? 'adminDashboard' : 'Home'
            this.$router.push({name: redirectTo})
          },
          error: function() {
            alert('email or password not valid')
          },
          rememberMe: true,
          fetchUser: true
        })
    }
  }
}
</script>

<style>
.login-container{
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
#login-form {
  width:400px;
  height: 400px;
  background-color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
#login-form input{
  margin: 10px 0;
  font-size: 25px;
}
</style>