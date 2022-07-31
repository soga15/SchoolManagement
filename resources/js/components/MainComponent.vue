<template>
  <v-app>
    <v-main>
     <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script>
  export default {
    mounted(){
      if (!this.authenticated) {
        this.$router.push('/auth')
      }
    },
    computed: {
      authenticated(){
        if (window.localStorage.getItem('token')) {
          return true
        }else{
          return false
        }
      }
    }
  }
</script>