<template>
  <v-data-table
    :headers="headers"
    :items="students"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>STUDENT DETAILS</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              Add Student
            </v-btn>
            
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="10"
                    
                  >
                    <v-text-field
                      v-model="editedItem.firstname"
                      label="Firstname"
                    ></v-text-field>
                  </v-col>

                  <v-col
                    cols="10"
                   
                  >
                    <v-text-field
                      v-model="editedItem.lastname"
                      label="Lastname"
                    ></v-text-field>
                  </v-col>

                  <v-col cols="6">
                    <v-select
                    v-model="editedItem.gender"
                      :items="items"
                      :menu-props="{ top: true, offsetY: true }"
                      label="Gender"
                    ></v-select>
                  </v-col>

                  <v-col
                    cols="10"
                    
                  >
                    <v-text-field
                      v-model="editedItem.address"
                      label="Address"
                    ></v-text-field>
                  </v-col>

                   <v-col
                  cols="6"
                 
                >
                  <v-menu
                    ref="menu"
                    v-model="menu"
                    :close-on-content-click="false"
                    :return-value.sync="editedItem.birthdate"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        v-model="editedItem.birthdate"
                        label="Birthdate"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="date"
                      no-title
                      scrollable
                    >
                      <v-spacer></v-spacer>
                      <v-btn
                        text
                        color="primary"
                        @click="menu = false"
                      >
                        Cancel
                      </v-btn>
                      <v-btn
                        text
                        color="primary"
                        @click="$refs.menu.save(date)"
                      >
                        OK
                      </v-btn>
                    </v-date-picker>
                  </v-menu>
                </v-col>
                 

                  <v-col
                    cols="10"
                    
                  >
                    <v-text-field
                      v-model="editedItem.email"
                      label="Email"
                    ></v-text-field>
                  </v-col>

                  <v-col
                    cols="10"
                    
                  >
                    <v-text-field
                      v-model="editedItem.password"
                      label="Password"
                    ></v-text-field>
                  </v-col>

                 <v-col cols="6">
                    <v-select
                    v-model="editedItem.class_id"
                      :items="iclass"
                      :menu-props="{ top: true, offsetY: true }"
                      label="Class_ID"
                    ></v-select>
                  </v-col>
                  


                  

                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>

              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>

            </v-card-actions>
          </v-card>
        </v-dialog>

         <v-dialog v-model="dialogView" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">VIEW STUDENT</v-card-title>
            <v-card-text>
               <v-row>
                  <v-col
                    cols="12"
                    
                  >
                    <h3>Student_ID: {{editedItem.id}}</h3>
                  </v-col>

                  <v-col
                    cols="12"
                    
                  >
                    <h3>FirstName: {{editedItem.firstname}}</h3>
                  </v-col>

                  <v-col
                    cols="12"
                    
                  >
                    <h3>LastName: {{editedItem.lastname}}</h3>
                  </v-col>

                  <v-col
                    cols="12"
                    
                  >
                    <h3>Gender: {{editedItem.gender}}</h3>
                  </v-col>

                  <v-col
                    cols="12"
                   
                  >
                    <h3>Address: {{editedItem.address}}</h3>
                  </v-col>

                  <v-col
                    cols="12"
                    
                  >
                    <h3>Birthdate: {{editedItem.birthdate}}</h3>
                  </v-col>

                  <v-col
                    cols="12"
                   
                  >
                    <h3>Email: {{editedItem.email}}</h3>
                  </v-col>

                   <v-col
                    cols="12"
                    
                  >
                    <h3>Password: {{editedItem.password}}</h3>
                  </v-col>

                   <v-col
                    cols="12"
                    
                  >
                    <h3>Class_ID: {{editedItem.class_id}}</h3>
                  </v-col>

                   <v-col
                    cols="12"
                   
                  >
                    <h3>ClassName: {{editedItem.class && editedItem.class.name}}</h3>
                  </v-col>

                  <v-col
                    cols="12"
                    
                  >
                    <h3>ClassDescription: {{editedItem.class && editedItem.class.description}}</h3>
                  </v-col>

                </v-row>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeView">Close</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this Student?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">

    <v-icon
        small
        @click="viewItem(item)"
      >
       mdi-eye-arrow-left
      </v-icon>


      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import axios from 'axios'

  export default {
    data: () => ({
      dialog: false,
      dialogView: false,
      dialogDelete: false,
      items: ['Male', 'Female'],
      iclass: ['1', '2', '4'],
      date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu: false,
      
      headers: [
        
        { text: 'Student_ID', value: 'id' },
        { text: 'Firstname',
          align: 'start',
          value: 'firstname'},
        { text: 'Lastname', value: 'lastname' },
        { text: 'Email', value: 'email' },
        { text: 'Class_Name', value: 'class.name' },
        { text: 'Actions', value: 'actions' },
      ],
      students: [],
      editedIndex: -1,
      editedItem: {
        firstname: '',
        lastname: '',
        gender: '',
        address: '',
        birthdate: '',
        email: '',
        password: '',
        class_id:'',
      },
      defaultItem: {
        firstname: '',
        lastname: '',
        gender: '',
        address: '',
        birthdate: '',
        email: '',
        password: '',
        class_id: '',
      },
    }),

   
    computed: {
      formTitle() {
        return this.editedIndex === -1 ? 'New Student' : 'Edit Student'
      },
    },

    watch: {
      dialog(val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },
    
    dialogView(val) {
        val || this.closeView()
    },

    created() {
      this.initialize()
    },

    methods: {
      initialize()
      {
        axios.get('api/student/index')
        .then(response=> {
          this.students = response.data
        }).catch(error => {
          console.log(error)
        })
      },

      viewItem(item) 
      {
        this.editedIndex = this.students.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogView = true
      },
     
      editItem(item) {
        this.editedIndex = this.students.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },
      updateItem(item) {
        axios.put(`api/student/update/${item.id}`, item)
        .then(response=> {
          console.log(response)
        }).catch(error =>{
          console.log(error)
        })
      },

      storeItem() {
        axios.post('api/student/create', this.editedItem)
        .then(response =>{
          console.log(response)
        }).catch(error =>{
          console.log(error)
        })
      },

      deleteItem(item) {
        this.editedIndex = this.students.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm() {
        axios.delete(`api/student/delete/${this.editedItem.id}`)
        .then(response =>{
          console.log(response)
        }).catch(error =>{
          console.log(error)
        })
        this.students.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close() {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete() {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeView() 
      {
        this.dialogView = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
        })
      },

      save() {
        if (this.editedIndex > -1) {
         this.updateItem(this.editedItem)
        } else {
         this.storeItem()
        }
        this.initialize()
        this.close()
      },
    },
  }
  
</script>
