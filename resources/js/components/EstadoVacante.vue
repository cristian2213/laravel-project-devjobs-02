<template>
  <span
    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full cursor-pointer"
    :class="checkValue"
    @click="cambiarEstado"
    :key="estadoVacanteData"
  >
    {{ estadoVacanteData === 1 ? "Activo" : "Inactivo" }}
  </span>
</template>


<script>
export default {
  props: {
    estado: {
      type: String,
      required: true,
    },
    vacanteId: {
      type: String,
      required: true,
    },
  },

  data() {
    return {
      estadoVacanteData: null,
    };
  },

  computed: {
    checkValue() {
      return this.estadoVacanteData === 1
        ? "bg-teal-100 text-green-800"
        : "bg-red-200 text-red-800";
    },
  },

  methods: {
    cambiarEstado() {
      if (this.estadoVacanteData === 1) {
        this.estadoVacanteData = 0;
      } else {
        this.estadoVacanteData = 1;
      }

      // enviar la peticion axios
      const params = {
        estado: this.estadoVacanteData,
      };
      // .todo lo que se envie en params se accede por medio del request
      axios
        .post("/vacantes/" + this.vacanteId, params)
        .then((res) => console.log(res.data))
        .catch((error) => console.log(error));
    },
  },

  mounted() {
    this.estadoVacanteData = Number(this.estado);
  },
};
</script>