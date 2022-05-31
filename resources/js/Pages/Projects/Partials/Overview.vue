<template>
     <div> <button class="px-5 p-2 border rounded-l-md" :class="{'bg-sky-500 text-white':!preview}" @click="preview=false">Editor</button><button class="p-5 py-2 border rounded-r-md" @click="preview=true" :class="{'bg-sky-500 text-white':preview}">Preview</button> </div>
     <div  class="w-full my-10 " >
           <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
          <!-- <ckeditor  class="border-b min-h-[55vh]"  :readonly="preview" :disabled="preview" :editor="editor" v-model="editorData" :config="editorConfig" ></ckeditor> -->
     </div>

</template>

<script>
     import CKEditor from '@ckeditor/ckeditor5-vue';
     import Editor from 'ckeditor5-custom-build/build/ckeditor';
     export default{
     props: ['project', 'token'],
          components: {
               ckeditor: CKEditor.component
          },

          data() {
               return {
                    markdown:'',
                    preview:false,
                    editor:  ClassicEditor,
                    // editorData: this.project.overview,
                     editorData: '<p>Content of the editor.</p>',
                    editorConfig: {
                         // cloudServices: {
                         //      // tokenUrl: '127.0.0.1:3000/upload',
                         //      uploadUrl: '192.168.0.10:3000/easyimage/upload/'
                         // }
                         ckfinder: {
                         // Upload the images to the server using the CKFinder QuickUpload command.
                         uploadUrl: route('project.upload', {'_token' : this.token}),
                         headers: {
                              '_token' : this.token
                         }
                              }
                       
                    }
               } 
          },

          methods: {
               saveChange() {
               console.log('hello');
               this.$inertia.put(route('project.update', {id:this.project.team_id, project:this.project.id}), {'overview':this.editorData})
               }
          }

      
     }
</script>