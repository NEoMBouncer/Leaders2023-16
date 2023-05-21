<template>
  <div class="divide-y">
    <h1 class="text-2xl font-semibold pb-5">Профиль</h1>
    <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
      <div>
        <h2 class="text-xl font-semibold leading-7">Персональные данные</h2>
        <p class="mt-1 text-sm leading-6 text-gray-400">Укажите Ваши персональные данные.</p>
      </div>

      <form class="md:col-span-2" @submit="savePersonal">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
          <div class="col-span-full flex items-center gap-x-8">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-24 w-24 flex-none rounded-lg bg-gray-800 object-cover" />
            <div>
              <button type="button" class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm">Change avatar</button>
              <p class="mt-2 text-xs leading-5 text-gray-400">JPG, GIF or PNG. 1MB max.</p>
            </div>
          </div>

          <div class="col-span-full">
            <label for="email" class="block text-sm font-medium leading-6">E-Mail</label>
            <div class="mt-2">
              <input
                  id="email"
                  name="email"
                  type="email"
                  autocomplete="email"
                  class="block mt-1 w-full bg-white border border-gray-300 rounded-md py-2 px-3 text-sm placeholder-gray-500 focus:outline-none focus:text-gray-900 focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
            </div>
          </div>

          <div class="col-span-full">
            <label for="username" class="block text-sm font-medium leading-6">Username</label>
            <div class="mt-2">
              <div class="flex rounded-md ring-1 ring-inset focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                <span class="flex select-none items-center pl-3 text-gray-400 sm:text-sm">example.com/</span>
                <input type="text" name="username" id="username" autocomplete="username" class="flex-1 border-0 bg-transparent py-1.5 pl-1  focus:ring-0 sm:text-sm sm:leading-6" placeholder="janesmith" />
              </div>
            </div>
          </div>

          <div class="col-span-full">
            <label for="timezone" class="block text-sm font-medium leading-6">Timezone</label>
            <div class="mt-2">
              <select id="timezone" name="timezone" class="block w-full rounded-md border-0  py-1.5  shadow-sm ring-1 ring-inset  focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 [&_*]:text-black">
                <option>Pacific Standard Time</option>
                <option>Eastern Standard Time</option>
                <option>Greenwich Mean Time</option>
              </select>
            </div>
          </div>
        </div>

        <div class="mt-8 flex">
          <base-button
              :html-type="'submit'"
              :type="'primary'"
              class="w-full inline-flex justify-center py-2 px-4 shadow-sm text-sm font-medium rounded-md">
            Сохранить
          </base-button>
        </div>
      </form>
    </div>

    <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
      <div>
        <h2 class="text-xl font-semibold leading-7 ">Изменить пароль</h2>
        <p class="mt-1 text-sm leading-6 text-gray-400">Обновите пароль, связанный с вашей учетной записью.</p>
      </div>

      <form class="md:col-span-2">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
          <div class="col-span-full">
            <label for="current-password" class="block text-sm font-medium leading-6">Текущий пароль</label>
            <div class="mt-2">
              <input id="current-password" name="current_password" type="password" autocomplete="current-password" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" />
            </div>
          </div>

          <div class="col-span-full">
            <label for="new-password" class="block text-sm font-medium leading-6 ">New password</label>
            <div class="mt-2">
              <input id="new-password" name="new_password" type="password" autocomplete="new-password" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" />
            </div>
          </div>

          <div class="col-span-full">
            <label for="confirm-password" class="block text-sm font-medium leading-6">Confirm password</label>
            <div class="mt-2">
              <input id="confirm-password" name="confirm_password" type="password" autocomplete="new-password" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" />
            </div>
          </div>
        </div>

        <div class="mt-8 flex">
          <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import BaseButton from "@/components/UI/BaseButton.vue";

export default {
  name: "Setting",
  components: {
    BaseButton
  },
  data() {
    return {
    }
  },
  methods: {
    savePersonal() {
      console.log('savePersonal')
    },
    editPassword() {
      console.log('savePersonal')
    },
  }
}
</script>

<style lang="scss" scoped>
</style>