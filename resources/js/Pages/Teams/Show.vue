<template>
    <app-layout title="Name Team" border="border-b border-gray-100" mx="mx-0">
        <template #hgroup>
            <div class="relative py-4 px-10">
                 <div class="flex justify-between mt-2">
                    <div class="flex gap-x-3 font-bold text-gray-500">
                      Projects
                    </div>
                      <div class="inline-flex gap-x-3">
                      <span class="border rounded-md p-1">
                          <img class="h-5" src="../../../../public/images/add_user.png" alt="">
                      </span>
                      <Link :href="(route('team.settings', {id:team.id}))" class="border rounded-md p-1" >
                          <img class="h-5" src="../../../../public/images/settings.png" alt="">
                      </Link>
                    </div>
                 
                </div>
            </div>
        </template>

        <template #side_nav>
            <div class="flex flex-col w-full sticky top-[7em] px-10 gap-y-10 ng-white">
            
              <img class="mx-auto w-44 h-44 rounded-full border-2 border-transparent ring-1" :src="team.avatar" alt="">

            <div>
                <span class=" font-thin text-gray-400">Name</span>
                <h1 class="text-3xl font-extrabold font-serif uppercase">
                   {{team.title}}
                </h1>
            </div>

            <div>
                <span class=" font-thin text-gray-400">Moto</span>
                <p class=" font-sans text-lg text-center text-gray-700">
                   {{team.description}}
                  
                  
                </p>
            </div>

            <button class="sticky bottom-5 z-50 py-2 rounded-md text-white font-extrabold bg-sky-600 border-2 border-transparent ring-2"> JOIN </button>
            </div>
        </template>

        <section class="flex gap-4 mb-10 mt-3 ">
            <div class="relative w-1/2 h-36 shadow-lg rounded-lg bg-sky-200 overflow-hidden">
                <div class="absolute top-0 w-full h-full  rounded-bl-full ml-10 bg-sky-50"></div>
                <div class="absolute top-0 w-full h-full  rounded-bl-full ml-14 bg-sky-500 bg-[length:50%] bg-no-repeat bg-right" style="background-image:url('../../../../images/users.svg')"></div>
                <div class="text-white text-xl uppercase font-extrabold absolute w-full h-full flex justify-center items-center">
                    <span class="text-5xl pr-1"> 12 </span> Users
                </div>
            </div>

           <div class="relative w-1/2 h-36 shadow-lg rounded-lg bg-sky-200 overflow-hidden">
                <div class="absolute top-0 w-full h-full  rounded-bl-full ml-10 bg-sky-50"></div>
                <div class="absolute top-0 w-full h-full  rounded-bl-full ml-14 bg-sky-500 bg-[length:50%] bg-no-repeat bg-right" style="background-image:url('../../../../images/project.svg')"></div>
                <div class="text-white text-xl uppercase font-extrabold absolute w-full h-full flex justify-center items-center">
                    <span class="text-5xl pr-1"> {{projects.length}}</span> Projects
                </div>
            </div>
        </section>

        <div class="">
            <div class="flex justify-between items-center  p-2 sticky top-16 my-10 z-10 bg-gray-100">
                <h4 class="font-bold">Projects </h4>
                <div>
                    <button @click="modalShow = true" type="button" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-1 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2 text-center ">Create Project</button>
                </div>
            </div>
            <div class="flex flex-col gap-y-4 min-w-full">
                <!-- {{team}} -->
                <div
                    class="bg-white  rounded-xl border shadow-sm p-1 "
                    v-for="project in projects" :key="project.id"
                >
                <Link :href="route('project.show', {id: team.id, project:project.id})">
                    <span class=" font-thin text-blue-700 text-xs px-4">category name</span>
                    <div class="flex gap-4 border-b pb-5 px-4 ">
                        <div >
                            <h1
                                class="text-md font-bold text-gray-800 first-letter:uppercase"
                            >
                                {{project.title }}
                            </h1>
                            <p class="text-sm text-gray-600 line-clamp-2">
                               {{project.description}}
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-between pl-2 px-4">
                        <span class="text-sm text-gray-500 py-4"
                            >Updated on jan 10</span
                        >
                        <div class="flex ml-4 pt-3">
                            <img
                                class="h-8 rounded-full border border-gray-50 -ml-3"
                                :src="`${
                                    'https://ui-avatars.com/api/?name=' +
                                    'team.name'
                                }`"
                                alt=""
                            />
                            <img
                                class="h-8 rounded-full border border-gray-50 -ml-3"
                                :src="`${
                                    'https://ui-avatars.com/api/?name=' +
                                    'team.name'
                                }`"
                                alt=""
                            />
                            <img
                                class="h-8 rounded-full border border-gray-50 -ml-3"
                                :src="`${
                                    'https://ui-avatars.com/api/?name=' +
                                    'team.name'
                                }`"
                                alt=""
                            />
                        </div>
                    </div>
                    </Link>
                </div>
            </div>
        </div>
    </app-layout>
    <Modal :show="modalShow" @close="modalShow = false">
           <header class="p-5 border-b">Add New Project</header>
           <div class="p-5">
               
               <Input title="Title" placeholder="type your Project title" v-model="project.title"/>
               <Input title="description" placeholder="type your team description" v-model="project.description"/>
               <button @click="submit" type="button" class=" float-right my-10 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-1 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2 text-center ">Save Project</button>

           </div>
    </Modal>
</template>
<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Modal from '@/Jetstream/Modal'
import Input from "../../Jetstream/Input.vue";
export default {
    props: ['team', 'projects'],
    components: { AppLayout, Link, Modal, Input },
    data() {
        return {
            modalShow:false,
            project: {
                title:'',
                description:'',
                team_id:this.team.id
            }
        }
    },

    methods: {
        submit() {
            return this.$inertia.post(route('project.store', {id:this.team.id}), this.project)
        }
    }
};
</script>
