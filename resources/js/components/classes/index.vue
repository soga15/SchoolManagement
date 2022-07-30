<template>
  <v-data-table
    :headers="headers"
    :items="classes"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>CLASSES DETAILS</v-toolbar-title>
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
              Add Class
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
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.name"
                      label="Name"
                    ></v-text-field>
                  </v-col>

                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.description"
                      label="Description"
                    ></v-text-field>
                  </v-col>
                
                     <v-col cols="6">
                    <v-select
                    v-model="editedItem.course_id"
                      :items="icourse"
                      :menu-props="{ top: true, offsetY: true }"
                      label="Course_ID"
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
            <v-card-title class="text-h5">VIEW CLASS</v-card-title>
            <v-card-text>
               <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <h3>Class_ID: {{editedItem.id}}</h3>
                  </v-col>

                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <h3>Name: {{editedItem.name}}</h3>
                  </v-col>

                   <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <h3>Description: {{editedItem.description}}</h3>
                  </v-col>

                  <v-col
                    cols="12"
                    
                  >
                    <h3>Course_ID: {{editedItem.course_id}}</h3>
                  </v-col>

                  <v-col
                    cols="12"
                   
                  >
                    <h3>CourseName: {{editedItem.course && editedItem.course.name}}</h3>
                  </v-col>

                   <v-col
                    cols="12"
                   
                  >
                    <h3>Description: {{editedItem.course && editedItem.course.description}}</h3>
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
            <v-card-title class="text-h5">Are you sure you want to delete this Class?</v-card-title>
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
      icourse: ['1', '2', '3', '4'],
      headers: [
        
        { text: 'Class_ID', value: 'id' },
        { text: 'Name',
          align: 'start',
          value: 'name'},
        {text: 'Description', value: 'description'},
        {text: 'Course', value: 'course.name'},
        { text: 'Actions', value: 'actions' },
      ],
      classes: [],
      editedIndex: -1,
      editedItem: {
        name: '',
        description: '',
        course_id: '',
      },
      defaultItem: {
        name: '',
        description: '',
        course_id:'',
      },
    }),

    computed: {
      formTitle() {
        return this.editedIndex === -1 ? 'New Class' : 'Edit Class'
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
        axios.get('api/classes/index')
        .then(response=> {
          this.classes = response.data
        }).catch(error => {
          console.log(error)
        })
      },

      viewItem(item) 
      {
        this.editedIndex = this.classes.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogView = true
      },
     
      editItem(item) {
        this.editedIndex = this.classes.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },
      updateItem(item) {
        axios.put(`api/classes/update/${item.id}`, item)
        .then(response=> {
          console.log(response)
        }).catch(error =>{
          console.log(error)
        })
      },

      storeItem() {
        axios.post('api/classes/create', this.editedItem)
        .then(response =>{
          console.log(response)
        }).catch(error =>{
          console.log(error)
        })
      },

      deleteItem(item) {
        this.editedIndex = this.classes.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm() {
        axios.delete(`api/classes/delete/${this.editedItem.id}`)
        .then(response =>{
          console.log(response)
        }).catch(error =>{
          console.log(error)
        })
        this.classes.splice(this.editedIndex, 1)
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
