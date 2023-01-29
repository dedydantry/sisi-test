import { defineStore } from "pinia";
export const useMenuStore = defineStore({
    id: 'menu',
    state: () => ({
      menu: localStorage.getItem('menu') ? JSON.parse(localStorage.getItem('menu')) : []
    }),

    getters: {
        getMenu: state => state.menu,
    },

    actions: {
        setMenu(arg){
            if(arg){
                this.menu = arg.map(x => {
                    x.current = false //x.menu_name === 'Dashboard'
                    return x
                })
                localStorage.setItem('menu', JSON.stringify(arg))
            } else {
                this.menu = []
                localStorage.removeItem('menu')
            }
        }
    }
})