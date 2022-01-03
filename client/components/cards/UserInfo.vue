<template>
  <div>
    <div v-if="!editing" class="flex flex-col items-center">
      <div class="flex flex-col items-center p-2">
        <img :src="avatar" class="object-scale-down w-16 h-16 rounded-full lg:w-24 lg:h-24" alt="Avatar">
      </div>
      <button @click="edit">
        <IconEdit class="w-5 h-5 pr-0 pl-auto justify-end" />
      </button>
      <div class="flex flex-col p-2 items-center">
        <p class="row-auto">{{ address }}</p>
        <p class="row-auto">{{ city }}, {{ state }} {{ zip }}</p>
      </div>
      <div class="flex flex-row p-2 items-center">
        <a :href="'mailto:' + email" class="text-indigo-500">{{ email }}</a>
      </div>
      <div class="flex flex-row justify-center p-2 m-auto">
        <a :href="github" class="text-indigo-500 pl-2">
          <IconGithub class="w-5 h-5" />
        </a>
      </div>
    </div>
    <div v-if="editing" class="flex flex-col items-center">
      <div class="md:grid md:grid-cols-1 w-screen px-44">
        <div class="mt-5 md:mt-0">
          <form action="#" @submit.prevent="save">
            <div class="shadow sm:rounded-md sm:overflow-hidden w-auto">
              <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <div class="grid grid-cols-3 gap-6">
                  <div class="col-span-3 sm:col-span-2">
                    <label for="avatar" class="block text-sm font-medium text-gray-700">
                      Avatar URL
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <input
                        id="avatar"
                        v-model="avatar"
                        type="text"
                        name="avatar"
                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                        placeholder="www.example.com"
                      >
                    </div>
                  </div>
                </div>
                <div>
                  <h2>Address Info: </h2>
                  <div class="mt-1">
                    <input
                      id="address"
                      v-model="address"
                      type="text"
                      name="address"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm"
                      placeholder="1234 Somewhere Ave"
                    >
                  </div>
                  <div class="mt-1">
                    <input
                      id="city"
                      v-model="city"
                      type="text"
                      name="city"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                      placeholder="City"
                    >
                  </div>
                  <div class="mt-1">
                    <input
                      id="state"
                      v-model="state"
                      type="text"
                      name="state"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                      placeholder="State"
                    >
                  </div>
                  <div class="mt-1">
                    <input
                      id="zip"
                      v-model="zip"
                      type="text"
                      name="zip"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                      placeholder="12345"
                    >
                  </div>
                </div>
                <div class="grid grid-cols-3 gap-6">
                  <div class="col-span-3 sm:col-span-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                      Email Address
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <input
                        id="email"
                        v-model="email"
                        type="text"
                        name="email"
                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                        placeholder="someone@somewhere.com"
                      >
                    </div>
                  </div>
                </div>
                <div class="grid grid-cols-3 gap-6">
                  <div class="col-span-3 sm:col-span-2">
                    <label for="github" class="block text-sm font-medium text-gray-700">
                      Github Account
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <input
                        id="github"
                        v-model="github"
                        type="text"
                        name="github"
                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                        placeholder="someone@somewhere.com"
                      >
                    </div>
                  </div>
                </div>
                <div class="px-4 py-3 text-right sm:px-6">
                  <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="reset">
                    Cancel
                  </button>
                  <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { User } from '~/client/types/api'
export default Vue.extend({
  props: {
    user: {
      type: Object as PropType<User>,
      required: true,
    },
  },
  data () {
    return {
      name: this.user.name,
      address: this.user.address,
      city: this.user.city,
      state: this.user.state,
      zip: this.user.zip,
      avatar: this.user.avatar,
      github: this.user.github,
      email: this.user.email,
      editing: false,
    }
  },
  mounted () {
    console.log(this.user)
  },
  methods: {
    edit (): void {
      this.editing = true
    },
    reset (): void {
      this.editing = false
      this.name = this.user.name
      this.address = this.user.address
      this.city = this.user.city
      this.state = this.user.state
      this.zip = this.user.zip
      this.avatar = this.user.avatar
      this.github = this.user.github
      this.email = this.user.email
    },
    async save (): Promise<any> {
      try {
        await this.$axios.put('/users/save/' + this.user.id, {
          name: this.name,
          address: this.address,
          city: this.city,
          state: this.state,
          zip: this.zip,
          email: this.email,
          github: this.github,
          avatar: this.avatar,
        })
        this.editing = false
        this.$emit('get', true)
      } catch (e) {
        if (e.response.status === 422) {
          let message: string = 'Please resolve the following errors:'
          if (e.response.data.errors.name) message += '<br> - ' + e.response.data.errors.name[0]
          if (e.response.data.errors.address) message += '<br> - ' + e.response.data.errors.address[0]
          if (e.response.data.errors.city) message += '<br> - ' + e.response.data.errors.city[0]
          if (e.response.data.errors.state) message += '<br> - ' + e.response.data.errors.state[0]
          if (e.response.data.errors.zip) message += '<br> - ' + e.response.data.errors.zip[0]
          if (e.response.data.errors.email) message += '<br> - ' + e.response.data.errors.email[0]
          if (e.response.data.errors.github) message += '<br> - ' + e.response.data.errors.github[0]
          if (e.response.data.errors.avatar) message += '<br> - ' + e.response.data.errors.avatar[0]
          this.$toast.danger(message)
        } else this.$toast.danger('An unknown error occurred while saving your changes.')
      }
    },
  },
})
</script>
