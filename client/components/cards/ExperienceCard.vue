<template>
  <li class="col-span-1 bg-white rounded-lg shadow">
    <div v-if="!isEditing" class="w-full flex items-center justify-between p-6 space-x-6">
      <div class="flex-1">
        <div class="flex items-center space-x-3">
          <h2 class="text-gray-900 text-sm leading-5 font-medium truncate">
            {{ experience.company }}
          </h2>
        </div>
        <h3 class="mt-1 text-gray-800 text-sm leading-5 truncate">
          {{ formatDate(start_date) }} to {{ formatDate(end_date) }}
        </h3>
        <p class="mt-1 text-gray-500 text-sm leading-5 truncate">
          {{ experience.title }}
        </p>
        <p class="mt-1 text-gray-500 text-sm leading-5">
          {{ experience.description }}
        </p>
      </div>
      <div class="px-4 py-3 text-right sm:px-6">
        <button type="submit" class="inline-flex justify-center py-2 px-4 text-sm font-medium rounded-md text-white" @click="edit">
          <IconEdit class="w-5 h-5" />
        </button>
        <button type="submit" class="inline-flex justify-center py-2 px-4 text-sm font-medium rounded-md text-white" @click="confirmDelete">
          <IconTrash class="w-5 h-5" />
        </button>
      </div>
    </div>
    <div v-if="isEditing" class="w-full flex items-center justify-between p-6 space-x-6">
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
    experience: {
      type: Object as PropType<Experience>,
      required: true,
    },
    userId: {
      type: Number as PropType<number>,
      required: true,
    },
  },
  data () {
    return {
      isEditing: false,
      company: this.experience.company,
      title: this.experience.title,
      description: this.experience.description,
      start_date: this.experience.start_date,
      end_date: this.experience.end_date,
    }
  },
  methods: {
    edit (): void {
      this.isEditing = true
    },
    reset (): void {
      this.isEditing = false
      this.company = this.experience.company
      this.title = this.experience.title
      this.description = this.experience.description
      this.start_date = this.experience.start_date
      this.end_date = this.experience.end_date
    },
    confirmSave (): void {
      this.$modal.show({
        type: 'warning',
        title: 'Please Confirm',
        body: 'Are you sure you want to save your changes?',
        primary: {
          label: 'Confirm',
          theme: 'red',
          action: () => {
            this.save()
            this.$toast.success('Saved!')
            this.$emit('get', true)
            this.isEditing = false
          },
        },
        secondary: {
          label: 'Cancel',
          theme: 'white',
          action: () => this.$toast.info('Cancelled'),
        },
      })
    },
    confirmDelete (): void {
      this.$modal.show({
        type: 'danger',
        title: 'Please Confirm',
        body: 'Are you sure you want to delete this experience?',
        primary: {
          label: 'Confirm',
          theme: 'red',
          action: () => this.delete(),
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
      }
      try {
        await this.$axios.put('experience/save/' + this.experience.id, data)
        this.$toast.success('Saved!')
        this.$emit('get', true)
        this.isEditing = false
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
    async delete (): Promise<void> {
      try {
        await this.$axios.delete('experience/delete/' + this.experience.id)
        this.$toast.success('Deleted!')
        this.$emit('get', true)
      } catch (e) {
        this.$toast.danger('Failed to delete experience!')
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
