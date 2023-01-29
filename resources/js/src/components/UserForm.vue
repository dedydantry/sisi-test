<template>
    <div class="">
        <div class="grid grid-cols-2 gap-5">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Name</label>
                <div class="mt-1">
                    <input v-model="name" type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1">
                <input type="email"  v-model="email"  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                </div>
            </div>
                <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="mt-1">
                <input type="email" v-model="password" :disabled="edit" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Phone</label>
                <div class="mt-1">
                <input type="text" v-model="phone" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Wa Number</label>
                <div class="mt-1">
                <input type="text" v-model="waNumber" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                </div>
            </div>
                <div>
                <label for="email" class="block text-sm font-medium text-gray-700">PIN</label>
                <div class="mt-1">
                <input type="text" v-model="pin" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                </div>
            </div>
        </div>
        <div class="mt-5 sm:mt-6">
        <button type="button" @click="onSubmit" class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:text-sm">SUBMIT</button>
        </div>
    </div>
</template>
<script>

export default{
    name:'UserForm',

    props:['edit'],

    created(){
        const data = this.edit
        if(data){
            const user = data
            this.email = user.email
            this.name = user.name
            this.phone = user.no_hp
            this.waNumber = user.wa
            this.pin = user.pin
        }
    },

    data(){
        return{
            email:'',
            name:'',
            password:'',
            phone:'',
            waNumber:'',
            pin:""
        }
    },

    methods:{
        onSubmit(){
            const params = {
                email:this.email,
                name:this.name,
                password:this.password,
                phone:this.phone,
                waNumber:this.waNumber,
                pin:this.pin,
            }
            this.$emit('submit', params)
        }
    }
}
</script>
