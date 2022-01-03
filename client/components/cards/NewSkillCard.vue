<template>
  <li class="col-span-1 bg-white rounded-lg shadow">
    <div class="w-full flex items-center justify-between p-6 space-x-6">
      <div class="flex-1 truncate">
        <div class="md:grid md:grid-cols-1">
          <div class="mt-5 md:mt-0">
            <form action="#" @submit.prevent>
              <div class="shadow sm:rounded-md sm:overflow-hidden w-auto">
                <div class="col-span-3 sm:col-span-2 p-2">
                  <label for="description" class="block text-sm font-medium text-gray-700">
                    Description
                  </label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <input
                      id="description"
                      v-model="description"
                      type="text"
                      name="description"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                      placeholder="Coding"
                    >
                  </div>
                </div>
                <div class="grid grid-cols-3 gap-6">
                  <div class="col-span-3 sm:col-span-2 p-2">
                    <label for="years_experience" class="block text-sm font-medium text-gray-700">
                      Years Experience
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <input
                        id="years_experience"
                        v-model="years_experience"
                        type="number"
                        name="years_experience"
                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                        placeholder="5"
                      >
                    </div>
                  </div>
                  <div class="px-4 py-3 text-right sm:px-6">
                    <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="reset">
                      Cancel
                    </button>
                    <button type="button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="confirmSave">
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
  </li>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { Skill } from '@/types/api'
export default Vue.extend({
  props: {
    userId: {
      type: Number as PropType<number>,
      required: true,
    },
  },
  data () {
    return {
      years_experience: '',
      description: '',
    }
  },
  methods: {
    reset (): void {
      this.description = ''
      this.years_experience = ''
      this.$emit('cancel', true)
    },
    confirmSave (): void {
      this.$modal.show({
        type: 'warning',
        title: 'Please Confirm',
        body: 'Are you sure you want to add this skill?',
        primary: {
          label: 'Confirm',
          theme: 'red',
          action: () => this.save(),
        },
        secondary: {
          label: 'Cancel',
          theme: 'white',
          action: () => this.$toast.info('Cancelled'),
        },
      })
    },
    async save (): Promise<void> {
      const data = {
        years_experience: this.years_experience,
        description: this.description,
        user_id: this.userId,
      } as Skill
      try {
        await this.$axios.post('skills/store/', data)
        this.$toast.success('Saved!')
        this.$emit('cancel', true)
        this.$emit('get', true)
      } catch (e) {
        if (e.response.status === 422) {
          let message: string = 'Please resolve the following errors:'
          if (e.response.data.errors.description) message += '<br> - ' + e.response.data.errors.description[0]
          if (e.response.data.errors.years_experience) message += '<br> - ' + e.response.data.errors.years_experience[0]
          this.$toast.danger(message)
        } else this.$toast.danger('An unknown error occurred while saving your changes.')
      }
    },
  },
})
</script>
