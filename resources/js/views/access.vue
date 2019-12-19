<template>
 <div>
  <PersonalAccessTokens></PersonalAccessTokens>
  <AuthorizedClients></AuthorizedClients>
  <Clients></Clients>
 </div>
</template>

<script>
import axios from 'axios';
import PersonalAccessTokens from '../components/Passport/PersonalAccessTokens'
import AuthorizedClients from '../components/Passport/AuthorizedClients'
import Clients from '../components/Passport/Clients'
export default {
name:'Shop',
 components: {
  PersonalAccessTokens,
  AuthorizedClients,
  Clients
  },
}
</script>

<style>

</style>