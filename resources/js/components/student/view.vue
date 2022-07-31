<template>
  <div>
    <v-card class="mx-5 my-5">
        <v-card-title><h4>VIEW STUDENT</h4></v-card-title>
        <v-card-text>
            <v-row>
                <v-col
                    cols="12"
                    sm="4"
                    >
                    <v-text-field
                        :value="student.firstname"
                        label="firstname"
                        solo
                        readonly
                    ></v-text-field>
                </v-col>
                <v-col
                    cols="12"
                    sm="4"
                    >
                    <v-text-field
                         :value="student.lastname"
                        label="lastname"
                        solo
                        readonly
                    ></v-text-field>
                </v-col>
                <v-col
                    cols="12"
                    sm="4"
                    >
                    <v-text-field
                         :value="student.gender"
                        label="gender"
                        solo
                        readonly
                    ></v-text-field>
                </v-col>
                <v-col
                    cols="12"
                    sm="4"
                    >
                    <v-text-field
                         :value="student.address"
                        label="address"
                        solo
                        readonly
                    ></v-text-field>
                </v-col>
                <v-col
                    cols="12"
                    sm="4"
                    >
                    <v-text-field
                         :value="student.birthdate"
                        label="birthdate"
                        solo
                        readonly
                    ></v-text-field>
                </v-col>
                <v-col
                    cols="12"
                    sm="4"
                    >
                    <v-text-field
                         :value="student.email"
                        label="email    "
                        solo
                        readonly
                    ></v-text-field>
                </v-col>

            </v-row>

             <v-row>
                <v-col cols="12">
                    <h4>Subjects</h4>
                </v-col>
                <v-col cols="12">
                    <v-data-table
                        :headers="headers"
                        :items="subjects"
                        :items-per-page="5"
                        class="elevation-1"
                    >

                  



                    <template v-slot:item.actions="{ item }">
                        <v-icon
                            small
                            class="mr-2"
                            @click="editItem(item)"
                        >
                            mdi-pencil
                        </v-icon>
                        
                    </template>
                    </v-data-table>
                      <v-dialog
                        v-model="dialog"
                        max-width="500px"
                        >     
                        <v-card> 
                            <v-card-text>
                            <v-container>
                                <v-row>

                               <v-col
                                    cols="12"
                                    sm="6"
                                >
                                <v-text-field
                                    :value="editedItem.name"
                                    label="SubjectName"
                                    readonly
                                ></v-text-field>
                                </v-col>
                                <v-col
                                    cols="12"
                                >
                                    <v-text-field
                                    v-model="editedItem.grade"
                                    label="Grade"
                                    ></v-text-field>
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
            </v-col>
            </v-row>
        </v-card-text>
        <v-card-actions>

        </v-card-actions>
    </v-card>
  </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            student: {},
            dialog: false,
            headers: [
                {
                    text: 'ID',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },
                { text: 'Name', value: 'name' },
                { text: 'Description', value: 'description' },
                { text: 'Code', value: 'code' },
                { text: 'Actions', value: 'actions' },
            ],
            editedIndex: -1,
            editedItem: {
                grade: '',
            },
            defaultItem: {
                grade:'',
            },
        }
    },
   
    created() {
        this.init()
    },
    computed: {
        subjects(){
            if (this.student.class && this.student.class.course && this.student.class.course.subjects) {
                 return this.student.class.course.subjects
            }else{
               return []
            }
        }
    },
    methods: {
        init() {
            axios.get(`api/student/${this.$route.params.id}`)
            .then(response=> {
                this.student = response.data
            }).catch(error => {
                console.log(error)
            })
        },
        async editItem(item) 
        {
            await axios.get(`api/subject/student-grade/${this.$route.params.id}/${item.id}`)
            .then(response=> {
                item.grade = response.data.grade
                console.log(item);
            }).catch(error => {
                console.log(error)
            })

            this.editedIndex = this.subjects.indexOf(item)
            this.editedItem = item
            this.dialog = true
        },
        evaluate(item) 
        {
            let payload = {
                student_id: this.$route.params.id,
                subject_id: item.id,
                grade: item.grade
            }
            axios.put(`api/subject/evaluate-grade`, payload)
            .then(response=> {
                console.log(response)
            }).catch(error =>{
                console.log(error)
            })
        },
        close() 
        {
            this.dialog = false
            this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
            })
        },
        save() 
        {
            if (this.editedIndex > -1) {
            this.evaluate(this.editedItem)
            } else {
            this.storeItem()
            }
            this.init()
            this.close()
        },
    },
}
</script>