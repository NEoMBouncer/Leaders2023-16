<template>
  <div class="divide-y questionnaire">
    <h1 class="text-2xl font-semibold pb-5">Анкета</h1>

    <template v-if="!loading">
      <!--    Персональные данные-->
      <div class="grid gap-x-8 gap-y-10 py-10">
        <div>
          <h2 class="text-xl font-semibold leading-7">Персональные данные</h2>
          <p class="mt-1 text-sm leading-6 text-gray-500">Поля, отмеченные <sup class="text-red-600">*</sup>, обязательны для заполнения.</p>
        </div>

        <div class="grid grid-cols-1 gap-x-6 gap-y-3 sm:max-w-xl sm:grid-cols-6">
          <div v-if="file" ref="cropper" class="col-span-full flex items-center gap-x-3">
            <div>
              <img
                  id="image"
                  class="h-24 w-24 flex justify-center items-center rounded-lg bg-gray-300 object-cover"
                  ref="image_new"
                  :src="image_new"
                  alt="Cropped Image"
              />
              <!--              <div class="flex items-center justify-center">-->
              <!--                <div @click="zoomIn" class="text-3xl font-semibold mr-6">-</div>-->
              <!--                <div @click="zoomOut" class="text-3xl font-semibold">+</div>-->
              <!--              </div>-->
            </div>
            <base-button
                type="primary"
                class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm"
                @click="apply"
            >
              Сохранить
            </base-button>
            <base-button
                type="secondary"
                class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm"
                @click="cancel"
            >
              Отменить
            </base-button>
          </div>
          <div v-else class="col-span-full flex items-center gap-x-8">
            <img
                v-if="avatarReady"
                class="h-24 w-24 flex justify-center items-center rounded-lg bg-gray-300 object-cover"
                :src="src_preview"
                alt="Cropped Image"
            />
            <div v-else class="h-24 w-24 flex justify-center items-center rounded-lg bg-gray-300 object-cover">
              <span class="text-xl font-medium leading-none">TW</span>
            </div>
            <div>
              <base-button
                  type="primary"
                  class="rounded-md px-3 py-2 text-sm font-semibold shadow-sm bg-gray-400"
                  @click="selectedImageHandler"
              >
                Загрузить аватар
              </base-button>
              <p class="mt-2 text-xs leading-5 text-gray-500">JPG, GIF or PNG. 1MB max.</p>
            </div>
          </div>
          <input ref="file_input" type="file" class="hidden" @change="fileSelected"/>
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
              v-model="formPerson.middlename"
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
              v-model="formPerson.age"
          />

          <base-select
              class="col-span-full"
              label="label"
              star
              select-label="Гражданство"
              v-model="formPerson.is_russian_citizenship"
              :options="russianCitizenshipOptions"
          />
        </div>
      </div>

      <!--контактная информация-->
      <div class="grid gap-x-8 gap-y-10 py-10">
        <div>
          <h2 class="text-xl font-semibold leading-7">Контактная информация</h2>
          <p class="mt-1 text-sm leading-6 text-gray-500">
            Поля, отмеченные <sup class="text-red-600">*</sup>, обязательны для заполнения.
          </p>
        </div>

        <div class="grid grid-cols-1 gap-x-6 gap-y-3 sm:max-w-xl sm:grid-cols-6">
          <BaseSelect
              class="col-span-full"
              v-model="formContacts.address"
              :options="optionsAddress"
              label="label"
              select-label="Город"
              :internal-search="false"
              :clearOnSelect="false"
              :preserveSearch="true"
              :clearable="true"
              @searchChange="onSearchChange"
          />
          <base-input
              class="col-span-full"
              star
              v-model="formContacts.phone"
              label="Мобильный телефон"
              v-maska="{mask: '+7 (###) ###-##-##', tokens: {'d':{pattern: /[1-9]/}, 'D':{pattern: /[0-9]/}, 'D':{pattern: /[0-9]/}}}"
          />
        </div>
      </div>

      <!--уровень образования-->
      <div class="grid gap-x-8 gap-y-2 py-10">
        <div>
          <h2 class="text-xl font-semibold leading-7">Уровень образования</h2>
          <p class="mt-1 text-sm leading-6 text-gray-500">
            Поля, отмеченные <sup class="text-red-600">*</sup>, обязательны для заполнения.
          </p>
          <p class="mt-1 text-sm leading-6 text-gray-500">
            Пожалуйста, укажите полное название вуза без использования аббревиатур.
          </p>
        </div>

        <div class="gap-x-6 gap-y-3 sm:max-w-xl">
          <div class="divide-y">
            <div
                v-for="(school, index) in schools"
                :key="index"
                class="grid gap-x-6 gap-y-3 pt-8 pb-6 sm:max-w-xl relative">
              <component
                  @click="removeSchool(index)"
                  is="TrashIcon"
                  v-if="index !== 0"
                  :class="['h-6 w-6 text-red-500 hover:text-red-600 absolute right-2 top-2 cursor-pointer']"
                  aria-hidden="true" />
              <base-select
                  class="col-span-full"
                  label="label"
                  star
                  select-label="Уровень образования"
                  v-model="school.levelEducation"
                  :options="levelEducationOptions"
              />
              <base-input
                  class="col-span-full"
                  v-model="school.institutionEducation"
                  label="Учебное заведение"
              />
              <BaseSelect
                  class="col-span-full"
                  v-model="school.addressEducation"
                  :options="optionsEducationAddress"
                  label="label"
                  select-label="Адрес учебного заведения"
                  :internal-search="false"
                  :clearOnSelect="false"
                  :preserveSearch="true"
                  :clearable="true"
                  @searchChange="onSearchEducationChange"
              />
              <base-input
                  class="col-span-full"
                  star
                  v-model="school.speciality"
                  label="Специальность"
              />
              <base-select
                  class="col-span-full"
                  label="label"
                  star
                  select-label="Начало учебы"
                  v-model="school.startSchool"
                  :options="startSchoolOptions"
              />
              <base-select
                  class="col-span-full"
                  label="label"
                  star
                  select-label="Завершение учебы"
                  v-model="school.endSchool"
                  :options="endSchoolOptions"
              />
            </div>
            <div @click="addSchool" class="text-sm pt-6 text-indigo-600 cursor-pointer">
              + Добавить дополнительное образование
            </div>
          </div>
        </div>
      </div>

      <!--опыт работы-->
      <div class="grid gap-x-8 gap-y-2 py-10">
        <div>
          <h2 class="text-xl font-semibold leading-7">Опыт работы</h2>
          <p class="mt-1 text-sm leading-6 text-gray-500">
            Пожалуйста, укажите последние места работы, начиная с последнего.
          </p>
          <p class="mt-1 text-sm leading-6 text-gray-500">
            Если на старом месте работы у Вас было продвижение по службе и существенно менялся уровень ответственности и обязанностей, укажите эту позицию отдельно.
          </p>
          <p class="mt-1 text-sm leading-6 text-gray-500">
            Поля, отмеченные <sup class="text-red-600">*</sup>, обязательны для заполнения.
          </p>
        </div>

        <div class="gap-x-6 gap-y-3 sm:max-w-xl">
          <div class="divide-y">
            <div
                v-for="(item, index) in experiences"
                :key="index"
                class="grid gap-x-6 gap-y-3 pt-8 pb-6 sm:max-w-xl relative">
              <component
                  @click="removeExperiences(index)"
                  is="TrashIcon"
                  v-if="index !== 0"
                  :class="['h-6 w-6 text-red-500 hover:text-red-600 absolute right-2 top-2 cursor-pointer']"
                  aria-hidden="true" />
              <base-select
                  class="col-span-full"
                  label="label"
                  star
                  select-label="Опыт работы"
                  v-model="isExperiences"
                  :options="experiencesOptions"
              />
              <base-input
                  v-if="isExperiences.value"
                  class="col-span-full"
                  type="number"
                  v-model="item.income"
                  label="Уровень дохода (руб.)"
              />
              <base-datepicker
                  v-if="isExperiences.value"
                  class="col-span-full"
                  label="Дата начала"
                  autoApply
                  v-model="item.startDate"
              />
              <base-datepicker
                  v-if="isExperiences.value"
                  class="col-span-full"
                  label="Дата окончания"
                  autoApply
                  v-model="item.endDate"
              />
              <base-input
                  v-if="isExperiences.value"
                  class="col-span-full"
                  v-model="item.organization"
                  label="Организация"
              />
              <base-select
                  v-if="isExperiences.value"
                  class="col-span-full multiple"
                  label="label"
                  select-label="Ключевые навыки"
                  v-model="item.keySkills"
                  multiple
                  :closeOnSelect="false"
                  :searchable="true"
                  :createTag="true"
                  :canClear="false"
                  :options="specializationsOptions"
              />
              <base-input
                  v-if="isExperiences.value"
                  class="col-span-full"
                  v-model="item.post"
                  label="Должность"
              />
              <base-input
                  v-if="isExperiences.value"
                  class="col-span-full"
                  v-model="item.responsibilities"
                  label="Обязанности"
              />
            </div>
            <div v-if="isExperiences.value" @click="addExperiences" class="text-sm pt-6 text-indigo-600 cursor-pointer">
              + Добавить дополнительный опыт работы
            </div>
          </div>
        </div>
      </div>

      <div class="mt-4 pt-4">
        <base-button
            @click="save"
            class="sm:max-w-xl inline-flex justify-center py-2 px-4 text-sm font-medium rounded-md">
          Сохранить
        </base-button>
      </div>
    </template>
    <loading v-else/>
  </div>
</template>

<script>
import BaseButton from "@/components/UI/BaseButton.vue";
import BaseInput from "@/components/UI/BaseInput.vue";
import BaseSelect from "@/components/UI/BaseSelect.vue";
import BaseDatepicker from "@/components/UI/BaseDatepicker.vue";
import Cropper from "cropperjs";
import {debounce} from 'lodash'
import axios from "axios";
import InternshipsCard from "@/components/InternshipsCard.vue";
import {
  TrashIcon,
} from '@heroicons/vue/24/outline'
import {mapActions, mapState} from "vuex";
import Loading from "@/components/Loading.vue";

export default {
  name: "Questionnaire",
  components: {
    Loading,
    InternshipsCard,
    BaseDatepicker,
    BaseSelect,
    BaseButton,
    BaseInput,
    Cropper,
    TrashIcon,
  },
  data() {
    return {
      loading: false,
      formPerson: {
        email: '',
        firstname: '',
        lastname: '',
        middlename: '',
        gender: null,
        age: null,
        is_russian_citizenship: null,
      },
      formContacts: {
        address: null,
        phone: ''
      },
      russianCitizenshipOptions: [],
      genderOptions: [
        {
          label: 'Мужской',
          value: 1
        },
        {
          label: 'Женский',
          value: 2
        },
      ],
      optionsAddress: [],
      optionsSchool: [],
      schools: [
        {
          levelEducation: null,
          institutionEducation: '',
          addressEducation: null,
          speciality: '',
          startSchool: null,
          endSchool: null,
        }
      ],
      optionsEducationAddress: [],
      levelEducationOptions: [
        {
          label: 'Высшее',
          value: 'Высшее'
        },
        {
          label: 'Высшее - бакалавриат',
          value: 'Высшее - бакалавриат'
        },
        {
          label: 'Высшее - магистратура',
          value: 'Высшее - магистратура'
        },
        {
          label: 'Доктор наук',
          value: 'Доктор наук'
        },
        {
          label: 'Кандидат наук',
          value: 'Кандидат наук'
        },
        {
          label: 'Мва',
          value: 'Мва'
        },
        {
          label: 'Среднее общее',
          value: 'Среднее общее'
        },
        {
          label: 'Среднее профессиональное',
          value: 'Среднее профессиональное'
        },
        {
          label: 'Прочее',
          value: 'Прочее'
        },
      ],
      startSchoolOptions: [],
      endSchoolOptions: [],
      specializationsOptions: [],
      isExperiences: {
        label: 'Нет',
        value: false
      },
      experiences: [
        {
          income: '',
          startDate: null,
          endDate: null,
          organization: '',
          post: '',
          responsibilities: '',
          keySkills: [],
        }
      ],
      experiencesOptions: [
        {
          label: 'Нет',
          value: false
        },
        {
          label: 'Да',
          value: true
        },
      ],
      //loader avatar
      file: null,
      cropper: null,
      src_preview: null,
      reload_avatar: null,
      avatarReady: false,
      image_new: null,
    }
  },
  computed: {
    ...mapState('cabinet', ['info']),
  },
  methods: {
    ...mapActions('cabinet', ['getSpecializations', 'getProfile', 'setUpdateProfile']),
    isImageFile(file) {
      if(file.type) {
        return /^image\/\w+$/.test(file.type)
      } else {
        return /\.(jpg|jpeg|png|gif)$/.test(file)
      }
    },
    selectedImageHandler() {
      this.$refs.file_input.click()
    },
    zoomIn() {
      this.cropper.zoom(0.1)
    },
    zoomOut() {
      this.cropper.zoom(-0.1)
    },
    cancel() {
      this.file = null
      this.cropper.destroy()
    },
    fileSelected(e) {
      if(this.isImageFile(e.target.files[0])) {
        this.file = e.target.files[0]
        this.image_new = URL.createObjectURL(e.target.files[0])
        if(this.cropper !== null) {
          this.cropper.destroy()
        }
        this.cropper = new Cropper(this.image_new, {
          viewMode: 1,
          dragMode: 'move',
          aspectRatio: 1,
          autoCropArea: 0.1,
          minCropBoxWidth: 96,
          minCropBoxHeight: 96,
          restore: false,
          guides: false,
          center: false,
          highlight: false,
          cropBoxMovable: false,
          cropBoxResizable: false,
          toggleDragModeOnDblclick: false,
          responsive: true
        })
        window.cropper = this.cropper
      } else {
        console.error('Sorry, FileReader API not supported');
      }
    },
    apply() {
      this.src_preview = URL.createObjectURL(this.file.target.files[0])
      this.file = null
    },
    onSearchChange: debounce(function callback(event) {
      if (event.length >= 1) {
        this.loadAddressSuggest(event);
      }
    }, 300),
    onSearchEducationChange: debounce(function callback(event) {
      if (event.length >= 1) {
        this.loadAddressEducationSuggest(event);
      }
    }, 300),
    async loadAddressEducationSuggest(e) {
      const apiUrl = import.meta.env.VITE_APP_FIAS_URL
      const token = import.meta.env.VITE_APP_FIAS_TOKEN
      try {
        const res = await axios
            .post(
                apiUrl,
                {
                  query: e,
                  count: 10,
                },
                {
                  headers: {
                    Authorization: `Token ${token}`,
                  },
                }
            );
        if(res.data?.suggestions?.length) {
          this.optionsEducationAddress = res.data.suggestions.map((item) => ({
            label: item.value,
            city: item.data?.city || "",
          }))
        }
      } catch(err) {
        console.error(err)
      }
    },
    async loadAddressSuggest(e) {
      const apiUrl = import.meta.env.VITE_APP_FIAS_URL
      const token = import.meta.env.VITE_APP_FIAS_TOKEN
      try {
        const res = await axios
            .post(
                apiUrl,
                {
                  query: e,
                  count: 10,
                },
                {
                  headers: {
                    Authorization: `Token ${token}`,
                  },
                }
            );
        if(res.data?.suggestions?.length) {
          this.optionsAddress = res.data.suggestions.map((item) => ({
            label: item.value,
            city: item.data?.city || "",
          }))
        }
      } catch(err) {
        console.error(err)
      }
    },
    addSchool() {
      this.schools.push(
          {
            levelEducation: null,
            institutionEducation: '',
            addressEducation: null,
            speciality: '',
            startSchool: null,
            endSchool: null,
          }
      )
    },
    removeSchool(index) {
      this.schools = this.schools.filter((item, indexItem) => indexItem !== index)
    },
    addExperiences() {
      this.experiences.push(
          {
            income: '',
            startDate: null,
            endDate: null,
            organization: '',
            post: '',
            responsibilities: '',
            keySkills: [],
          }
      )
    },
    removeExperiences(index) {
      this.experiences = this.experiences.filter((item, indexItem) => indexItem !== index)
    },
    save() {
      const schools = this.schools?.map((item) => ({
        ...item,
        levelEducation: item?.levelEducation?.value || '',
        addressEducation: item?.addressEducation?.city || '',
        addressEducationFull: item?.addressEducation?.label || '',
        startSchool: item?.startSchool?.value || '',
        endSchool: item?.endSchool?.value || ''
      })) || []
      const experiences = this.experiences?.map((item) => ({
        ...item,
        experiences: item?.experiences?.value || 0,
        startDate: new Date(item?.startDate)?.getTime() || '',
        endDate: new Date(item?.endDate)?.getTime() || '',
        keySkills: item?.keySkills?.map((e) => e.value)
      })) || []
      const payload = {
        // formPerson
        firstname: this.formPerson?.firstname || '',
        lastname: this.formPerson?.lastname || '',
        middlename: this.formPerson?.middlename || '',
        gender: this.formPerson?.gender?.value || '',
        age: new Date(this.formPerson?.age)?.getTime() || '',
        is_russian_citizenship: this.formPerson?.is_russian_citizenship?.value || '',
        // formContacts
        city: this.formContacts?.address?.city || '',
        fullAddress: this.formContacts?.address?.label || '',
        phone: this.formContacts?.phone?.replace(/\s|[^a-zA-ZА-Яа-яёЁ0-9]/g, "") || '',
        // schools
        schools: schools || [],
        // experiences
        experiences: experiences || [],
      }
      console.log('save', payload)
    }
  },
  async mounted() {
    this.loading = true
    let yearsArray = [];
    for (let i = 2023; i >= 1950; i--) {
      let yearObj = { label: i.toString(), value: i };
      yearsArray.push(yearObj);
    }
    this.startSchoolOptions = yearsArray
    let yearsArrayEnd = [];
    for (let i = 2033; i >= 1960; i--) {
      let yearObj = { label: i.toString(), value: i };
      yearsArrayEnd.push(yearObj);
    }
    this.endSchoolOptions = yearsArrayEnd
    await this.getSpecializations().then((res) => {
      this.specializationsOptions = res.map((item) => ({
        label: item.title || '',
        value: item?.id || ''
      }))
    })
    await this.getProfile()
        .then((e) => {
          this.russianCitizenshipOptions = e?.country_id?.list?.map((item) => ({
            label: item.name || '',
            value: item?.id || ''
          })) || []
          this.formPerson = {
            email: this.info?.email || '',
            firstname: e?.firstname || '',
            lastname: e?.lastname || '',
            middlename: e?.middlename || '',
            age: e?.age ? new Date(e?.age) : null,
            gender: this.genderOptions?.find(item => item.value === e.gender) || null,
            is_russian_citizenship: this.russianCitizenshipOptions?.find(item => item.value === e.country_id.value) || null,
          }
          this.formContacts = {
            address: null,
            phone: e?.phone || ''
          }
        })
        .finally(() => {
          this.loading = false
        })
    this.loading = false
  }
}
</script>

<style lang="scss" scoped>
.questionnaire {
  &-input--disabled {
    cursor: not-allowed;
  }
  .multiple {
    max-height: 100%;
    height: auto;
    :deep(.multiselect__tags) {
      max-height: 100%;
      height: auto;
    }
  }
}
</style>