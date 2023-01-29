<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <p class="mt-2 text-sm text-gray-700">A list of all Menu</p>
      </div>
    </div>
    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">User</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Module</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Controller</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Function</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Line</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Message</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="(item,index) in errors" :key="index">
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ item.user ? item.user.name : '-' }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ item.modules}}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ item.controller}}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ item.function}}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ item.error_line}}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ item.error_message}}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ item.created_at}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
   
  </div>
</template>
<script>
export default {
    data(){
        return{
            errors:[],
        }
    },

    created(){
        this.fetchError()
    },

    methods:{
        async fetchError(){
            try {
                const {data} = await this.axios.get('/api/error-log')
                this.errors = data
            } catch (error) {
                throw error
            }
        },
    }
}
</script>
