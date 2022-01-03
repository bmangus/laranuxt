import { Plugin } from '@nuxt/types'
import axios from 'axios'

const getUserData = async () => {
  return await axios.get('users/all')
}

declare module '@nuxt/types' {
  interface Context {
    getUserData(): Promise<any>
  }
}

declare module 'vue/types/vue' {
  interface Vue {
    getUserData: typeof getUserData
  }
}

const plugins: Plugin = (_context: Object, inject: Function) => {
  inject('getUserData', getUserData)
}

export default plugins
