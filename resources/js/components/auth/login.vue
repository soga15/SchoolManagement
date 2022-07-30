<template>
   <v-app >
      <v-main>
         <v-container fluid fill-height>
            <v-layout align-center justify-center>
               <v-flex xs12 sm8 md4>
                  <v-card class="elevation-12">
                     <v-toolbar dark color="primary">
                        <v-toolbar-title>Login form</v-toolbar-title>
                     </v-toolbar>
                     <v-card-text>
                     <form ref="form" @submit.prevent="login()">
                            <v-text-field
                              v-model="email"
                              name="email"
                              label="Email"
                              type="text"
                              placeholder="email"
                              required
                           ></v-text-field>
                           
                           <v-text-field
                              v-model="password"
                              id="password"
                              name="password"
                              label="Password" 
                              :type="show ?'text': 
                              'password'"
                              :append-icon="show ?'mdi-eye':'mdi-eye-off'"   
                              placeholder="password"
                              required
                              @click:append="show=!show">
                           </v-text-field>
                           <v-btn type="submit" class="mt-4" color="primary" value="log in">Login</v-btn>
                      </form>
                     </v-card-text>
                  </v-card>
                
               </v-flex>
            </v-layout>
         </v-container>
      </v-main>
   </v-app>
</template>

<script>
import axios from 'axios'


export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
      show: false,
    };
  },
  methods: {
    login() {
      const payload = {
         email: this.email,
         password: this.password
      }
      const headers = {
         'Accept': 'application/json',
         'Content-Type': 'application/json',
      }
        axios.post('api/signin', payload, {headers: headers})
        .then(response =>{
          if (response.data.token) {
            window.localStorage.setItem('token', response.data.token)
            window.location.reload()
          }
        }).catch(error =>{
          console.log(error)
        })
    },
  },
  
};
</script>
