<template>
    <app-layout border="border-b border-gray-100" mx="mx-0">
      <template #header>
            <div class="relative">
                <div class="flex">
                    <div class="flex flex-col gap-y-3">
                        <span class=" uppercase text-sm font-thin text-gray-500"
                            >
                            {{team.title}}
                            </span
                        >
                        <h1
                            class="text-3xl font-extrabold font-serif uppercase"
                        >
                            {{project.title}}
                        </h1>
                    </div>
                    <div class="absolute right-0 top-7">
                        <div class="inline-flex gap-x-3"> 
                            <img class=" w-6"  src="../../../../public/images/github3.png" alt="">
                            <img class=" w-6" src="../../../../public/images/slack1.png" alt="">
                            <img class=" w-6" src="../../../../public/images/web-link.png" alt="">

                        </div>
                    </div>
                </div>
                <div class="flex justify-between mt-5">
                    <div class="inline-flex gap-x-3 font-bold text-gray-500">
                     
                      <Link :href="route('project.show', {'id' :team.id, 'project' : project.id})" class="rounded-md -ml-3 py-[5px] px-3"
                         :class="{'bg-gray-200 text-sky-600': route().current('project.show')}">Overview</Link>
                      <Link :href="route('project.task', {'id' :team.id, 'pid' : project.id})" 
                       class="rounded-md  py-[5px] px-3" :class="{'bg-gray-200 text-sky-600': route().current('project.task')}">tasks</Link>
                      <button  class=" rounded-md px-3 py-[5px] ">people</button>
                    </div>
                    <div>
                      <div class="inline-flex gap-x-3">
                      <button @click="showModal = true;" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-1 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2 text-center">Create Board</button>
                      <span class="border rounded-md px-3 py-[5px]">%</span>
                    </div>
                    </div>
                </div>
            </div>
     
      </template>

          <div v-if="route().current('project.show')">
           <Overview :project="project" :token="token"/>

          </div>
           <div v-else-if="route().current('project.task')">
              <Boards :boards="boards" :tasks="tasks" @showModal="getData"/>
          </div>
          
        </app-layout>
    <Modal :show="showModal" @close="showModal = false; newTask = false">
           <header class="p-5 border-b">
               <p v-if="newTask"> Add New Project </p>
               <p v-else> Add New Board </p>
            </header>
           <div v-if="newTask" class="p-5">
               <Input title="Title" placeholder="type your Project title" v-model="task.title"/>
               <Input title="description" placeholder="type your team description" v-model="task.description"/>
               <Input title="category" placeholder="type your team description" v-model="task.category"/>
                <button type="button" @click="createTask" class=" float-right my-10 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-1 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2 text-center ">Save Project</button>

           </div>
           <div v-else class="p-5">
               <Input title="Title" placeholder="type your Project title" v-model="board.title"/>
               <button type="button" @click="createBoard" class=" float-right my-10 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-1 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2 text-center ">Save Project</button>

           </div>
    </Modal>
</template>

<script>
   import { Head, Link } from '@inertiajs/inertia-vue3';
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Modal from '@/Jetstream/Modal'
    import Input from '../../Jetstream/Input.vue';
    import Overview from './Partials/Overview.vue'
    import Boards from './Partials/Boards.vue'
import Button from '../../Jetstream/Button.vue';
    export default defineComponent({
        props:['boards', 'tasks', 'project', 'team', 'token'],
        components: {
            AppLayout,
            Head,
            Link,
            Modal,
            Input,
            Overview,
            Boards
        },
        data() {
            return {
                showModal:false,
                newTask:false,
                board: {
                    title:'',
                    project_id:this.project.id
                },

                task: {
                    title:'',
                    discription:'',
                    category:'',
                    board_id:''

                }
            }
        },

        methods: {
            createBoard() {
                this.$inertia.post(route('board.store'), this.board)
            },
             createTask() {
                this.$inertia.post(route('task.store'), this.task)
            },
            
            getData($id) {
                 this.task.board_id = $id;
                 this.newTask = true
                 this.showModal = true
            }

        }
    })
</script>