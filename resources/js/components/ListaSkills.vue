<template>
  <div>
    <ul
      class="flex flex-wrap justify-center"
      v-if="listaSkills"
      id="listSkills"
    >
      <li
        v-for="skill in listaSkills"
        :key="skill.id"
        class="skill-item border border-gray-500 px-10 py-3 mb-3 rounded mr-4 cursor-pointer"
        :class="toggleSelected(skill.nombre)"
        @click="selectSkill($event, skill.nombre)"
      >
        {{ skill.nombre }}
      </li>
    </ul>

    <!-- input que leera php -->
    <input type="hidden" name="skills" id="skills" :value="oldFields" />
  </div>
</template>

<script>
export default {
  props: {
    listaSkills: {
      type: Array,
      required: true,
    },
    oldFields: {
      type: String,
      required: false,
      default: function (value) {
        return value ? value : null;
      },
    },
  },

  data() {
    return {
      /* para no repetir los datos */
      selectedSkills: new Set(),
    };
  },

  methods: {
    selectSkill(event, name) {
      if (event.target.classList.contains("bg-teal-500")) {
        // eliminando clase y skill del set "selectedSkills"
        event.target.classList.remove("bg-teal-500");
        this.selectedSkills.delete(name);
      } else {
        event.target.classList.add("bg-teal-500");
        this.selectedSkills.add(name);
      }

      // agregar datos al input, los set no se pueden agregar debe ser un array
      document.getElementById("skills").value = Array.from(this.selectedSkills);
    },
    toggleSelected(skill) {
      console.log(this.selectedSkills.has(skill));
      // comprobar que exista el elemento en el set
      return this.selectedSkills.has(skill) ? "bg-teal-500" : "";
    },
  },

  created() {
    // cuando la validacion falla se debe cargar otra vez el set con los datos que retorna el servidor, sino se hace entonces los datos que estan al macenados en memoria (set) se pierden
    if (this.oldFields) {
      // convertir los datos recibidos del servidor a un array
      const splitSkills = this.oldFields.split(",");
      // agregar los datos del servidor al set
      splitSkills.forEach((skill) => this.selectedSkills.add(skill));
      /*
      ESTA ES OTRA MANERA DE HACER LOS MISMO, PERO SE DEBE USAR EL MOUNTED
      // obtener el valor del input que guarda todas las habilidades seleccionadas y convertir a un array
      const inputSkills = document.getElementById("skills").value;
      const splitSkillsInput = inputSkills.split(",");

      // obtener todos los li de las habilidades
      const listSkills = document.querySelectorAll("#listSkills .skill-item");

      // iterar todos los li
      for (let i = 0; i < listSkills.length; i++) {
        // iterar las habilidades seleccionadas
        for (let j = 0; j < splitSkillsInput.length; j++) {
          // comprobar que el valor del li sea igual al valor seleccionado que retorna como respuesta el servidor
          if (listSkills[i].textContent.trim() === splitSkillsInput[j].trim()) {
            listSkills[i].classList.add("bg-teal-500");
          }
        }
      }*/
    }
  },
};
</script>

