import { defineStore } from "pinia";
import Cookies from 'js-cookie'
export const useAuthStore = defineStore({
    id: 'auth',
    state: () => ({
      user: Cookies.get('user') ?  JSON.parse(Cookies.get('user')) : null,
      access_token:Cookies.get('access_token') ?  Cookies.get('access_token') : null,
    }),

    getters: {
        getUser: state => state.user,
        getToken: state => state.access_token
    },

    actions: {
        setUser(arg){
            if(arg){
                this.user = arg
                Cookies.set('user', JSON.stringify(arg))
            } else {
                this.user = null
                this.access_token = ''
                Cookies.remove('user')
                Cookies.remove('access_token')
            }
        }
    }
})