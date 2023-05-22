<template>
  <div class="divide-y profile">
    <h1 class="text-2xl font-semibold pb-5">Профиль</h1>
    <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
      <div>
        <h2 class="text-xl font-semibold leading-7">Персональные данные</h2>
        <p class="mt-1 text-sm leading-6 text-gray-400">Укажите Ваши персональные данные.</p>
      </div>

      <div class="md:col-span-2">
        <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:max-w-xl sm:grid-cols-6">
          <div class="col-span-full flex items-center gap-x-8">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-24 w-24 flex-none rounded-lg bg-gray-800 object-cover" />
            <div>
              <button type="button" class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm">Change avatar</button>
              <p class="mt-2 text-xs leading-5 text-gray-400">JPG, GIF or PNG. 1MB max.</p>
            </div>
          </div>
          <base-input
              class="col-span-full"
              disabled
              v-model="formPerson.email"
              label="E-Mail"
          />
          <base-input
              class="col-span-full"
              star
              v-model="formPerson.firstname"
              label="Имя"
          />
          <base-input
              class="col-span-full"
              star
              v-model="formPerson.lastname"
              label="Фамилия"
          />
          <base-input
              class="col-span-full"
              star
              v-model="formPerson.surname"
              label="Отчество"
          />

          <base-select
              class="col-span-full"
              label="label"
              star
              select-label="Пол"
              v-model="formPerson.gender"
              :options="genderOptions"
          />

          <base-datepicker
              class="col-span-full"
              label="Дата рождения"
              star
              autoApply
              v-model="formPerson.date"
          />

          <base-select
              class="col-span-full"
              label="label"
              star
              select-label="Гражданство"
              v-model="formPerson.gender"
              :options="genderOptions"
          />

          <div class="mt-8 flex col-span-full">
            <base-button
                @click="savePersonal"
                class="w-full inline-flex justify-center py-2 px-4 shadow-sm text-sm font-medium rounded-md">
              Сохранить
            </base-button>
          </div>
        </div>
      </div>
    </div>

    <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
      <div>
        <h2 class="text-xl font-semibold leading-7 ">Изменить пароль</h2>
        <p class="mt-1 text-sm leading-6 text-gray-400">Обновите пароль, связанный с вашей учетной записью.</p>
      </div>

      <div class="md:col-span-2">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
          <div class="col-span-full relative">
            <label class="block text-sm font-medium text-gray-700">
              Текущий пароль
              <sup class="text-red-600">*</sup>
            </label>
            <input
                v-model="formPassword.old"
                id="password_old"
                type="password"
                class="block mt-1 w-full bg-white border border-gray-300 rounded-md py-2 px-3 text-sm placeholder-gray-500 focus:outline-none focus:text-gray-900 focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            />
            <div class="pass-visible" @click="visiblePassOld()">
              <svg v-if="!isPassOldVisible" class="ico-pass-visible"  width="20" height="15" viewBox="0 0 22 15" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 0C3 0 0 8 0 8C0 8 3 16 11 16C19 16 22 8 22 8C22 8 19 0 11 0ZM11 3C13.761 3 16 5.239 16 8C16 10.761 13.761 13 11 13C8.239 13 6 10.761 6 8C6 5.239 8.239 3 11 3ZM11 5C10.2044 5 9.44129 5.31607 8.87868 5.87868C8.31607 6.44129 8 7.20435 8 8C8 8.79565 8.31607 9.55871 8.87868 10.1213C9.44129 10.6839 10.2044 11 11 11C11.7956 11 12.5587 10.6839 13.1213 10.1213C13.6839 9.55871 14 8.79565 14 8C14 7.20435 13.6839 6.44129 13.1213 5.87868C12.5587 5.31607 11.7956 5 11 5Z" />
              </svg>
              <svg v-else class="ico-pass-visible" width="20" height="18" viewBox="0 0 22 18" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.9903 0.990234C2.79137 0.990287 2.59697 1.04967 2.43196 1.16078C2.26695 1.27189 2.13883 1.42969 2.06397 1.614C1.98911 1.79832 1.97093 2.00077 2.01173 2.19547C2.05253 2.39017 2.15048 2.56828 2.29304 2.70703L4.07624 4.49023C2.14437 6.04173 0.891589 7.94401 0.271553 9.06055C-0.0604472 9.65855 -0.0495409 10.3785 0.275459 10.9805C1.43046 13.1185 4.75107 18 11.0001 18C13.0756 18 14.8061 17.4547 16.2423 16.6562L18.293 18.707C18.3852 18.803 18.4956 18.8796 18.6177 18.9324C18.7398 18.9852 18.8712 19.0131 19.0043 19.0144C19.1373 19.0158 19.2693 18.9906 19.3925 18.9403C19.5157 18.89 19.6276 18.8157 19.7216 18.7216C19.8157 18.6275 19.8901 18.5156 19.9404 18.3924C19.9907 18.2692 20.0159 18.1373 20.0145 18.0042C20.0132 17.8712 19.9853 17.7397 19.9325 17.6176C19.8797 17.4955 19.8031 17.3851 19.7071 17.293L3.7071 1.29297C3.61391 1.19717 3.50247 1.12103 3.37935 1.06903C3.25624 1.01704 3.12395 0.990242 2.9903 0.990234ZM11.0001 2C9.78807 2 8.70586 2.19972 7.71687 2.51172L10.2774 5.07227C10.5144 5.03727 10.7531 5 11.0001 5C13.7611 5 16.0001 7.239 16.0001 10C16.0001 10.247 15.9628 10.4857 15.9278 10.7227L19.3575 14.1523C20.4315 12.9603 21.2176 11.7513 21.6876 10.9473C22.0416 10.3433 22.0401 9.60133 21.7051 8.98633C20.5361 6.83333 17.2191 2 11.0001 2ZM6.83405 7.24805L8.29694 8.71094C8.10823 9.10083 8.00007 9.53657 8.00007 10C8.00007 11.657 9.34307 13 11.0001 13C11.4635 13 11.8992 12.8918 12.2891 12.7031L13.754 14.168C12.7604 14.8268 11.5207 15.1424 10.1993 14.9375C8.10129 14.6115 6.38857 12.8988 6.06257 10.8008C5.85774 9.48 6.17582 8.24139 6.83405 7.24805Z" />
              </svg>
            </div>
          </div>

          <div class="col-span-full relative">
            <label class="block text-sm font-medium text-gray-700">
              Новый пароль
              <sup class="text-red-600">*</sup>
            </label>
            <input
                v-model="formPassword.password"
                id="password"
                type="password"
                class="block mt-1 w-full bg-white border border-gray-300 rounded-md py-2 px-3 text-sm placeholder-gray-500 focus:outline-none focus:text-gray-900 focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            />
            <div class="pass-visible" @click="visiblePass()">
              <svg v-if="!isPassVisible" class="ico-pass-visible"  width="20" height="15" viewBox="0 0 22 15" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 0C3 0 0 8 0 8C0 8 3 16 11 16C19 16 22 8 22 8C22 8 19 0 11 0ZM11 3C13.761 3 16 5.239 16 8C16 10.761 13.761 13 11 13C8.239 13 6 10.761 6 8C6 5.239 8.239 3 11 3ZM11 5C10.2044 5 9.44129 5.31607 8.87868 5.87868C8.31607 6.44129 8 7.20435 8 8C8 8.79565 8.31607 9.55871 8.87868 10.1213C9.44129 10.6839 10.2044 11 11 11C11.7956 11 12.5587 10.6839 13.1213 10.1213C13.6839 9.55871 14 8.79565 14 8C14 7.20435 13.6839 6.44129 13.1213 5.87868C12.5587 5.31607 11.7956 5 11 5Z" />
              </svg>
              <svg v-else class="ico-pass-visible" width="20" height="18" viewBox="0 0 22 18" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.9903 0.990234C2.79137 0.990287 2.59697 1.04967 2.43196 1.16078C2.26695 1.27189 2.13883 1.42969 2.06397 1.614C1.98911 1.79832 1.97093 2.00077 2.01173 2.19547C2.05253 2.39017 2.15048 2.56828 2.29304 2.70703L4.07624 4.49023C2.14437 6.04173 0.891589 7.94401 0.271553 9.06055C-0.0604472 9.65855 -0.0495409 10.3785 0.275459 10.9805C1.43046 13.1185 4.75107 18 11.0001 18C13.0756 18 14.8061 17.4547 16.2423 16.6562L18.293 18.707C18.3852 18.803 18.4956 18.8796 18.6177 18.9324C18.7398 18.9852 18.8712 19.0131 19.0043 19.0144C19.1373 19.0158 19.2693 18.9906 19.3925 18.9403C19.5157 18.89 19.6276 18.8157 19.7216 18.7216C19.8157 18.6275 19.8901 18.5156 19.9404 18.3924C19.9907 18.2692 20.0159 18.1373 20.0145 18.0042C20.0132 17.8712 19.9853 17.7397 19.9325 17.6176C19.8797 17.4955 19.8031 17.3851 19.7071 17.293L3.7071 1.29297C3.61391 1.19717 3.50247 1.12103 3.37935 1.06903C3.25624 1.01704 3.12395 0.990242 2.9903 0.990234ZM11.0001 2C9.78807 2 8.70586 2.19972 7.71687 2.51172L10.2774 5.07227C10.5144 5.03727 10.7531 5 11.0001 5C13.7611 5 16.0001 7.239 16.0001 10C16.0001 10.247 15.9628 10.4857 15.9278 10.7227L19.3575 14.1523C20.4315 12.9603 21.2176 11.7513 21.6876 10.9473C22.0416 10.3433 22.0401 9.60133 21.7051 8.98633C20.5361 6.83333 17.2191 2 11.0001 2ZM6.83405 7.24805L8.29694 8.71094C8.10823 9.10083 8.00007 9.53657 8.00007 10C8.00007 11.657 9.34307 13 11.0001 13C11.4635 13 11.8992 12.8918 12.2891 12.7031L13.754 14.168C12.7604 14.8268 11.5207 15.1424 10.1993 14.9375C8.10129 14.6115 6.38857 12.8988 6.06257 10.8008C5.85774 9.48 6.17582 8.24139 6.83405 7.24805Z" />
              </svg>
            </div>
          </div>

          <div class="col-span-full relative">
            <label class="block text-sm font-medium text-gray-700">
              Потвердите пароль
              <sup class="text-red-600">*</sup>
            </label>
            <input
                v-model="formPassword.password_confirm"
                id="password_confirm"
                type="password"
                class="block mt-1 w-full bg-white border border-gray-300 rounded-md py-2 px-3 text-sm placeholder-gray-500 focus:outline-none focus:text-gray-900 focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            />
            <div class="pass-visible" @click="visiblePassConfirmation()">
              <svg v-if="!isPassConfirmationVisible" class="ico-pass-visible"  width="20" height="15" viewBox="0 0 22 15" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 0C3 0 0 8 0 8C0 8 3 16 11 16C19 16 22 8 22 8C22 8 19 0 11 0ZM11 3C13.761 3 16 5.239 16 8C16 10.761 13.761 13 11 13C8.239 13 6 10.761 6 8C6 5.239 8.239 3 11 3ZM11 5C10.2044 5 9.44129 5.31607 8.87868 5.87868C8.31607 6.44129 8 7.20435 8 8C8 8.79565 8.31607 9.55871 8.87868 10.1213C9.44129 10.6839 10.2044 11 11 11C11.7956 11 12.5587 10.6839 13.1213 10.1213C13.6839 9.55871 14 8.79565 14 8C14 7.20435 13.6839 6.44129 13.1213 5.87868C12.5587 5.31607 11.7956 5 11 5Z" />
              </svg>
              <svg v-else class="ico-pass-visible" width="20" height="18" viewBox="0 0 22 18" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.9903 0.990234C2.79137 0.990287 2.59697 1.04967 2.43196 1.16078C2.26695 1.27189 2.13883 1.42969 2.06397 1.614C1.98911 1.79832 1.97093 2.00077 2.01173 2.19547C2.05253 2.39017 2.15048 2.56828 2.29304 2.70703L4.07624 4.49023C2.14437 6.04173 0.891589 7.94401 0.271553 9.06055C-0.0604472 9.65855 -0.0495409 10.3785 0.275459 10.9805C1.43046 13.1185 4.75107 18 11.0001 18C13.0756 18 14.8061 17.4547 16.2423 16.6562L18.293 18.707C18.3852 18.803 18.4956 18.8796 18.6177 18.9324C18.7398 18.9852 18.8712 19.0131 19.0043 19.0144C19.1373 19.0158 19.2693 18.9906 19.3925 18.9403C19.5157 18.89 19.6276 18.8157 19.7216 18.7216C19.8157 18.6275 19.8901 18.5156 19.9404 18.3924C19.9907 18.2692 20.0159 18.1373 20.0145 18.0042C20.0132 17.8712 19.9853 17.7397 19.9325 17.6176C19.8797 17.4955 19.8031 17.3851 19.7071 17.293L3.7071 1.29297C3.61391 1.19717 3.50247 1.12103 3.37935 1.06903C3.25624 1.01704 3.12395 0.990242 2.9903 0.990234ZM11.0001 2C9.78807 2 8.70586 2.19972 7.71687 2.51172L10.2774 5.07227C10.5144 5.03727 10.7531 5 11.0001 5C13.7611 5 16.0001 7.239 16.0001 10C16.0001 10.247 15.9628 10.4857 15.9278 10.7227L19.3575 14.1523C20.4315 12.9603 21.2176 11.7513 21.6876 10.9473C22.0416 10.3433 22.0401 9.60133 21.7051 8.98633C20.5361 6.83333 17.2191 2 11.0001 2ZM6.83405 7.24805L8.29694 8.71094C8.10823 9.10083 8.00007 9.53657 8.00007 10C8.00007 11.657 9.34307 13 11.0001 13C11.4635 13 11.8992 12.8918 12.2891 12.7031L13.754 14.168C12.7604 14.8268 11.5207 15.1424 10.1993 14.9375C8.10129 14.6115 6.38857 12.8988 6.06257 10.8008C5.85774 9.48 6.17582 8.24139 6.83405 7.24805Z" />
              </svg>
            </div>
          </div>
          <div class="mt-8 flex col-span-full">
            <base-button
                @click="editPassword"
                class="w-full inline-flex justify-center py-2 px-4 shadow-sm text-sm font-medium rounded-md">
              Сохранить
            </base-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BaseButton from "@/components/UI/BaseButton.vue";
import BaseInput from "@/components/UI/BaseInput.vue";
import BaseSelect from "@/components/UI/BaseSelect.vue";
import BaseDatepicker from "@/components/UI/BaseDatepicker.vue";

export default {
  name: "Profile",
  components: {
    BaseDatepicker,
    BaseSelect,
    BaseButton,
    BaseInput
  },
  data() {
    return {
      formPerson: {
        email: '',
        firstname: '',
        lastname: '',
        surname: '',
        gender: null,
        date: null,
      },
      formPassword: {
        old: '',
        password: '',
        password_confirm: '',
      },
      genderOptions: [
        {
          label: 'Мужской',
          value: 'men'
        },
        {
          label: 'Женский',
          value: 'woman'
        },
      ],
      isPassOldVisible: false,
      isPassVisible: false,
      isPassConfirmationVisible: false,
    }
  },
  methods: {
    savePersonal() {
      console.log('savePersonal')
    },
    editPassword() {
      console.log('savePersonal')
    },
    visiblePassOld () {
      this.isPassOldVisible = !this.isPassOldVisible;
      document.getElementById('password_old').setAttribute(
          "type",
          this.isPassOldVisible ? "input" : "password"
      );
    },
    visiblePass () {
      this.isPassVisible = !this.isPassVisible;
      document.getElementById('password').setAttribute(
          "type",
          this.isPassVisible ? "input" : "password"
      );
    },
    visiblePassConfirmation() {
      this.isPassConfirmationVisible = !this.isPassConfirmationVisible;
      document.getElementById('password_confirm').setAttribute(
          "type",
          this.isPassConfirmationVisible ? "input" : "password"
      );
    },
  },
  mounted() {
    this.formPerson.email = 'test@test.ru'
  }
}
</script>

<style lang="scss" scoped>
.profile {
  &-input--disabled {
    cursor: not-allowed;
  }
  .pass-visible {
    position: absolute;
    top: 32px;
    right: 10px;
    height: 21px;
    display: flex;
    align-items: center;
    cursor: pointer;

    .ico-pass-visible {
      fill: #1e1e1e;
      opacity: 0.2;
      margin-right: 5px;
    }

    [dir="rtl"] & {
      right: auto;
      left: 0;
    }
  }
}
</style>