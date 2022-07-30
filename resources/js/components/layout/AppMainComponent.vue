<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
    >
    
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="text-h6">
           <img src="../../../../public/logo3.png" alt="color" style="height: 16vh; width: 14vw; "/>
          
          </v-list-item-title>
          
          <v-list-item-subtitle>
            School Management
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
    
      <v-divider></v-divider>

      <v-list
        dense
        nav
      >
      
        <v-list-item
            v-for="item in items"
            :key="item.title"
            :to="item.to"
            link    
          >
          
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>
            
            

            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
        
        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
              <v-btn outlined color="black" dark v-bind="attrs" v-on="on">
                <v-icon left small>mdi-plus-thick</v-icon>Manage<v-icon
                  color="black"
                  right
                  small
                  >mdi-chevron-down</v-icon
                >
              </v-btn>
            </template>
            <v-list>
              <v-list-item
                v-for="(item, index) in itemcourse"
                :key="index"
                router
                :to="item.to"
                style="max-height: 0px"
              >
                <v-list-item-title>
                  <v-icon left small>{{ item.icon }}</v-icon
                  >{{ item.title }}</v-list-item-title
                >
              </v-list-item>
            </v-list>
          </v-menu>

        <v-list-item style="cursor:pointer;color:red" @click="logout">
           <v-list-item-icon>
            <v-icon  color="red">mdi-logout</v-icon>
          </v-list-item-icon>
          

          <v-list-item-content>
            <v-list-item-title>LogOut</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

     <v-app-bar
      app
      color="primary"
      dark
      prominent
      src="hello.png"
    >
      <template v-slot:img="{ props }">
        <v-img
          v-bind="props"
          gradient="to top right, rgba(55,236,186,.7), rgba(25,32,72,.7)"
        ></v-img>
      </template>

      <v-app-bar-nav-icon @click="drawer = ! drawer"></v-app-bar-nav-icon>

      <v-app-bar-title>SchoolManagement</v-app-bar-title>

      <v-spacer></v-spacer>

      
    </v-app-bar>

    
     <router-view></router-view>
    
  </v-app>
</template>

<script>
import axios from 'axios'

  export default {
    data: () => ({
       drawer: null,
         itemcourse: [
        { title: 'Course', icon: 'mdi-bookmark-check', to: '/course'},
        { title: 'Classes', icon: 'mdi-google-classroom', to: '/classes'},
        { title: 'Room', icon: 'mdi-door', to: '/room' },
        { title: 'Subject', icon: 'mdi-book', to: '/subject'},
        { title: 'Student', icon: 'mdi-account-school', to: '/student'},
        ],
        
      
        items: [

          { title: 'Dashboard', icon: 'mdi-view-dashboard', to: '/dashboard' },
          { title: 'User', icon: 'mdi-account-circle', to: '/user' },
          { title: 'Roles', icon: 'mdi-alpha-a-box', to: '/role' },
          
        ],
       }),
       methods: {
          logout(){
            const token = window.localStorage.getItem('token');
            const headers = {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
              'Authorization': `Bearer ${token}`
            }
            axios.post('api/signout',{}, {headers: headers})
            .then(response =>{
              console.log(response.data)
              window.localStorage.removeItem('token')
              window.location.reload()
            }).catch(error =>{
              console.log(error)
           })
        }
       },
  }
</script>