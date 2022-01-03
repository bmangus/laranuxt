<template>
  <li class="col-span-1 bg-white rounded-lg shadow">
    <div class="w-full flex items-center justify-between p-6 space-x-6">
      <div class="flex-1 truncate">
        <div class="md:grid md:grid-cols-1">
          <div class="mt-5 md:mt-0">
            <form action="#" @submit.prevent>
              <div class="shadow sm:rounded-md sm:overflow-hidden w-auto">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                  <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                      <label for="company" class="block text-sm font-medium text-gray-700">
                        Company
                      </label>
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          id="company"
                          v-model="company"
                          type="text"
                          name="company"
                          class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                          placeholder="Acme Corp"
                        >
                      </div>
                    </div>
                  </div>
                  <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                      <label for="start_date" class="block text-sm font-medium text-gray-700">
                        Start Date
                      </label>
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          id="start_date"
                          v-model="start_date"
                          type="date"
                          name="start_date"
                          class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                          placeholder="date"
                        >
                      </div>
                    </div>
                  </div>
                  <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                      <label for="end_date" class="block text-sm font-medium text-gray-700">
                        End Date
                      </label>
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          id="end_date"
                          v-model="end_date"
                          type="date"
                          name="end_date"
                          class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                          placeholder="date"
                        >
                      </div>
                    </div>
                  </div>
                  <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                      <label for="title" class="block text-sm font-medium text-gray-700">
                        Title
                      </label>
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          id="title"
                          v-model="title"
                          type="text"
                          name="title"
                          class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                          placeholder="CEO"
                        >
                      </div>
                    </div>
                  </div>
                  <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                      <label for="description" class="block text-sm font-medium text-gray-700">
                        Job Description
                      </label>
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <textarea
                          id="description"
                          v-model="description"
                          name="description"
                          rows="5"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md"
                          placeholder="Important Stuff"
                        />
                      </div>
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
import { Experience } from '@/client/types/api'
export default Vue.extend({
  props: {
    userId: {
      type: Number as PropType<number>,
      required: true,
    },
  },
  data () {
    return {
      company: '',
      title: '',
      description: '',
      start_date: '',
      end_date: '',
    }
  },
  methods: {
    reset (): void {
      this.company = ''
      this.title = ''
      this.description = ''
      this.start_date = ''
      this.end_date = ''
      this.$emit('cancel', true)
    },
    confirmSave (): void {
      this.$modal.show({
        type: 'warning',
        title: 'Please Confirm',
        body: 'Are you sure you want to add this experience?',
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
        company: this.company,
        title: this.title,
        description: this.description,
        start_date: this.start_date,
        end_date: this.end_date,
        user_id: this.userId,
      } as Experience
      try {
        await this.$axios.post('experience/store/', data)
        this.$toast.success('Saved!')
        this.$emit('cancel', true)
        this.$emit('get', true)
      } catch (e) {
        if (e.response.status === 422) {
          let message: string = 'Please resolve the following errors:'
          if (e.response.data.errors.company) message += '<br> - ' + e.response.data.errors.company[0]
          if (e.response.data.errors.title) message += '<br> - ' + e.response.data.errors.title[0]
          if (e.response.data.errors.start_date) message += '<br> - ' + e.response.data.errors.start_date[0]
          if (e.response.data.errors.end_date) message += '<br> - ' + e.response.data.errors.end_date[0]
          if (e.response.data.errors.description) message += '<br> - ' + e.response.data.errors.description[0]
          this.$toast.danger(message)
        } else this.$toast.danger('An unknown error occurred while saving your changes.')
      }
    },
    formatDate (dateStr: string | null): string {
      if (typeof dateStr === 'string') {
        const date = new Date(dateStr)
        return date.toLocaleDateString(undefined, { month: 'long', year: 'numeric' })
      }
      return 'Present'
    },
  },
})
</script>
