<template>

      <main class="mb-10">
        <div class="flex gap-x-3 overflow-auto">
            <div class="  w-48 min-w-[300px] bg-sky-200 bg-opacity-10 border rounded-md p-2" v-for="board in boards" :key="board.id">
                    <div class="w-full bg-white font-bold pl-4 py-4 mb-7 rounded-md"> {{board.title}} <span class=" cursor-pointer hover:bg-gradient-to-tr to-slate-600 float-right pr-5 text-xl font-extrabold" @click="newTask(board.id, $event)">+</span></div>
                    <div class="flex flex-col gap-y-4">
                    <div class=" rounded-md pt-5 gap-y-4 bg-white" v-for="task in board.tasks" :key="task.id">
                    <span class="ml-4 border rounded-3xl font-bold bg-yellow-200 text-blue-700 text-xs px-4 py-1 mb-1">Desgin</span>
                    <div class="flex gap-4 border-b pb-5 px-4 pt-2">
                        <div>
                            <h1
                                class="text-md font-bold text-gray-800 first-letter:uppercase"
                            >
                                {{ task.title }}
                            </h1>
                            <p class="text-sm text-gray-600 line-clamp-2">
                                {{ task.description}}
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-between pl-2 px-4">
                        <span class="text-sm text-gray-500 py-4"
                            >jan 10</span
                        >
                        <div class="flex ml-4 pt-3">
                            <img
                                class="h-8 rounded-full border border-gray-50 "
                                :src="`${
                                    'https://ui-avatars.com/api/?name=' +
                                    'team.name'
                                }`"
                                alt=""
                            />
                           
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </main>
 
</template>

<script>
  export default ({
      props: ['project', 'tasks', 'boards'],
   
      methods: {
          newTask($id) {
              this.$emit('showModal', $id)
          }
      },
  })
</script>