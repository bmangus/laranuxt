<template>
  <li class="col-span-1 bg-white rounded-lg shadow">
    <div v-if="!isEditing" class="w-full flex items-center justify-between p-6 space-x-6">
      <div class="flex-1">
        <div class="flex items-center space-x-3">
          <h2 class="text-gray-900 text-sm leading-5 font-medium truncate">
            {{ skill.description }}
          </h2>
        </div>
        <h3 class="mt-1 text-gray-800 text-sm leading-5 truncate">
          {{ skill.years_experience }} years
        </h3>
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
                  <div class="col-span-3 sm:col-span-2">
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
                    <div class="col-span-3 sm:col-span-2">
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
import { Skill } from '@/client/types/api'
export default Vue.extend({
  props: {
    skill: {
      type: Object as PropType<Skill>,
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
      description: this.skill.description,
      years_experience: this.skill.years_experience,
    }
  },
  methods: {
    edit (): void {
      this.isEditing = true
    },
    reset (): void {
      this.isEditing = false
      this.description = this.skill.description
      this.years_experience = this.skill.years_experience
    },
    confirmSave (): void {
      this.$modal.show({
        type: 'warning',
        title: 'Please Confirm',
        body: 'Are you sure you want to save your changes?',
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
    confirmDelete (): void {
      this.$modal.show({
        type: 'danger',
        title: 'Please Confirm',
        body: 'Are you sure you want to delete this skill?',
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
        description: this.description,
        years_experience: this.years_experience,
        user_id: this.userId,
      }
      try {
        await this.$axios.put('skills/save/' + this.skill.id, data)
        this.$toast.success('Saved!')
        this.$emit('get', true)
        this.isEditing = false
      } catch (e) {
        if (e.response.status === 422) {
          let message: string = 'Please resolve the following errors:'
          if (e.response.data.errors.description) message += '<br> - ' + e.response.data.errors.description[0]
          if (e.response.data.errors.years_experience) message += '<br> - ' + e.response.data.errors.years_experience[0]
          this.$toast.danger(message)
        } else this.$toast.danger('An unknown error occurred while saving your changes.')
      }
    },
    async delete (): Promise<void> {
      try {
        await this.$axios.delete('skills/delete/' + this.skill.id)
        this.$toast.success('Deleted!')
        this.$emit('get', true)
      } catch (e) {
        this.$toast.danger('Failed to delete skill!')
      }
    },
  },
})
</script>
