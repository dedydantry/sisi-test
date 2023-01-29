<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p>
      </div>
      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        <button type="button" @click="() => {togglePopup = true, editItem =null}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add user</button>
      </div>
    </div>
    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Username</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Phone</th>
                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="(item,index) in users" :key="index">
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ item.name }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ item.email }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ item.user_name }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ item.no_hp }}</td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                    <a href="javascript:;" @click="onEdit(item, index)" class="text-indigo-600 hover:text-indigo-900"
                      >Edit<span class="sr-only">, {{ item.name }}</span></a
                    > |
                    <a href="javascript:;" @click="() => postDelete(item, index)" class="text-indigo-600 hover:text-indigo-900"
                      >Delete<span class="sr-only">, {{ item.name }}</span></a
                    > |
                    <a href="javascript:;" @click="() => onSetMenu(item, index)" class="text-indigo-600 hover:text-indigo-900"
                      >Assign menu<span class="sr-only">, {{ item.name }}</span></a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <Popup :open="togglePopup" @close="togglePopup = false">
        <user-form @submit="onPostUser" :edit="editItem"/>
    </Popup>
    <Popup :open="toggleMenuPopup" @close="toggleMenuPopup = false">
        <div class="py-2 mb-20 pb-10">
            <label for="email" class="block text-sm font-medium text-gray-700">Select Menu</label>
             <v-select :options="menus" v-model="selectedMenu" label="menu_name" multiple></v-select>
        </div>
        <div class="mt-5 sm:mt-6">
        <button type="button" @click="onSubmitFormMenu" class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:text-sm">SAVE</button>
        </div>
    </Popup>
  </div>
</template>
<script>
import Popup from '../../components/Popup.vue'
import UserForm from '../../components/UserForm.vue'
export default {
    data(){
        return{
            users:[],
            togglePopup:false,
            editItem:null,
            toggleMenuPopup:false,
            menus:[],
            selectedMenu:[]
        }
    },

    components:{
        Popup,
        UserForm
    },

    created(){
      this.fetchUser()
    },

    methods:{

        async fetchUser(){
            try {
                const {data} = await this.axios.get('/api/user')
                this.users = data
            } catch (error) {
                throw error
            }
        },

        onPostUser(params){
            if(this.editItem) return this.postUpdate(params)
            return this.postUser(params)
        },

        async postUpdate(params){
            try {
                const {status,data} = await this.axios.put(`/api/user/${this.editItem.id}`, params)
                this.users[this.editItem.index] = data
                this.togglePopup = false
            } catch (error) {
                throw error
            }
        },

        async postUser(params){
            try {
                const {data} = await this.axios.post('/api/user', params)
                this.users.push(data)
                this.togglePopup = false
            } catch (error) {
                throw error
            }
        },

        async postDelete({id}, index){
            try {
                const {status} = await this.axios.delete(`/api/user/${id}`)
                if(status){
                    this.users.splice(index, 1)
                }
            } catch (error) {
                throw error
            }
        },

        onEdit(item,index){
            item.index = index
            this.editItem = item
            this.togglePopup = true
        },

        async fetchMenu(){
            try {
                const {data} = await this.axios.get('/api/menu')
                this.menus = data
            } catch (error) {
                throw error
            }
        },

        async onSetMenu(item){
          if(!this.menus.length){
            await this.fetchMenu()
          }
          this.toggleMenuPopup = true
          this.editItem = item
        },

        async onSubmitFormMenu(){
            try {
                const params = this.selectedMenu.map(x => x.id)
                if(!params.length) return

                const {status, data, message} = await this.axios.post(`/api/user/${this.editItem.id}/set-menu`, {menus:params})
                if(status){
                    this.toggleMenuPopup = false
                }
            } catch (error) {
                throw error
            }
        }

    }
}
</script>
