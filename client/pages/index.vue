<template>
  <div class="container p-2 lg:p-8 flex flex-col">
    <div v-if="users.length &gt; 0" class="m-8 flex items-center justify-center">
      <UserInfo :user="users[0]" @get="get" />
    </div>
    <div class="hidden sm:block" aria-hidden="true">
      <div class="py-5">
        <div class="border-t border-gray-200" />
      </div>
    </div>
    <div class="mt-10 sm:mt-0">
      <div class="md:grid md:grid-cols-4 md:gap-6">
        <div class="md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Experience</h3>
            <p class="mt-1 text-sm text-gray-600">
              All pertinent work history.
            </p>
          </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-3">
          <ul v-if="experiences.length === 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full grid-cols-1">
            <skeleton v-for="i in 5" :key="`skel-${i}`" />
          </ul>
          <ul v-if="users.length &gt; 0 && experiences.length &gt; 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full grid-cols-1">
            <experience-card
              v-for="experience in experiences"
              :key="experience.id"
              :experience="experience"
              :editing="experience.isNew"
              :user-id="users[0].id"
              @get="get"
            />
            <new-experience-card v-if="isAddingExperience" :user-id="users[0].id" @get="get" @cancel="cancelAddingExperience" />
          </ul>
          <div v-if="!isAddingExperience" class="px-4 py-3 text-right sm:px-6">
            <button type="button" class="inline-flex justify-center py-2 px-4 text-sm font-medium rounded-md text-white" @click="addExperience">
              <IconPlus class="w-5 h-5" />
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="hidden sm:block" aria-hidden="true">
      <div class="py-5">
        <div class="border-t border-gray-200" />
      </div>
    </div>
    <div class="mt-10 sm:mt-0">
      <div class="md:grid md:grid-cols-4 md:gap-6">
        <div class="md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Skills</h3>
            <p class="mt-1 text-sm text-gray-600">
              Relevant job skills and years of experience.
            </p>
          </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-3">
          <ul v-if="skills.length === 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full grid-cols-1">
            <skeleton v-for="i in 5" :key="`skel-${i}`" />
          </ul>
          <ul v-if="users.length &gt; 0 && skills.length &gt; 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full grid-cols-1">
            <skill-card
              v-for="skill in skills"
              :key="skill.id"
              :skill="skill"
              :user-id="users[0].id"
              @get="get"
            />
            <new-skill-card v-if="isAddingSkill" :user-id="users[0].id" @get="get" @cancel="cancelAddingSkill" />
          </ul>
          <div v-if="!isAddingSkill" class="px-4 py-3 text-right sm:px-6">
            <button type="button" class="inline-flex justify-center py-2 px-4 text-sm font-medium rounded-md text-white" @click="addSkill">
              <IconPlus class="w-5 h-5" />
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="hidden sm:block" aria-hidden="true">
      <div class="py-5">
        <div class="border-t border-gray-200" />
      </div>
    </div>
    <div class="mt-10 sm:mt-0">
      <div class="md:grid md:grid-cols-4 md:gap-6">
        <div class="md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Interests</h3>
            <p class="mt-1 text-sm text-gray-600">
              Hobbies and activities during off hours.
            </p>
          </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-3">
          <ul v-if="interests.length === 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full grid-cols-1">
            <skeleton v-for="i in 5" :key="`skel-${i}`" />
          </ul>
          <ul v-if="users.length &gt; 0 && interests.length &gt; 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full grid-cols-1">
            <interest-card
              v-for="interest in interests"
              :key="interest.id"
              :interest="interest"
              :user-id="users[0].id"
              @get="get"
            />
            <new-interest-card v-if="isAddingInterest" :user-id="users[0].id" @get="get" @cancel="cancelAddingInterest" />
          </ul>
          <div v-if="!isAddingInterest" class="px-4 py-3 text-right sm:px-6">
            <button type="button" class="inline-flex justify-center py-2 px-4 text-sm font-medium rounded-md text-white" @click="addInterest">
              <IconPlus class="w-5 h-5" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { Skills, Interests, Experiences, Users } from '@/types/api'
export default Vue.extend({
  data () {
    const users:Users = []
    const experiences:Experiences = []
    const interests:Interests = []
    const skills:Skills = []
    const isAddingExperience = false
    const isAddingSkill = false
    const isAddingInterest = false

    return {
      users,
      experiences,
      interests,
      skills,
      isAddingExperience,
      isAddingSkill,
      isAddingInterest,
    }
  },
  mounted () {
    this.get()
  },
  methods: {
    async get (): Promise<void> {
      // await this.$sleep(1000)
      this.users = (
        await this.$axios.get('users/index')
       ).data as Users
      this.experiences = (
        await this.$axios.get('experience/index')
      ).data as Experiences
      this.skills = (
        await this.$axios.get('skills/index')
      ).data as Skills
      this.interests = (
        await this.$axios.get('interests/index')
      ).data as Interests
    },
    addExperience () {
      this.isAddingExperience = true
    },
    cancelAddingExperience () {
      this.isAddingExperience = false
    },
    addSkill () {
      this.isAddingSkill = true
    },
    cancelAddingSkill () {
      this.isAddingSkill = false
    },
    addInterest () {
      this.isAddingInterest = true
    },
    cancelAddingInterest () {
      this.isAddingInterest = false
    },
  },
})
</script>

<style>
.skeleton {
  @apply text-opacity-0;
  background-image: linear-gradient(100deg, #edf2f7 0%, #f4f7fa 20%, #edf2f7 40%);
  background-position: 50%;
  background-size: 200%;
  animation: skeleton 1.5s infinite linear;
}
@keyframes skeleton {
  0% {
    background-position: 50%;
  }
  50%, 100% {
    background-position: -90%
  }
}
</style>
