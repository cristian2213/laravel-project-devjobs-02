<template>
  <a
    class="text-red-600 hover:text-red-900 mr-5 cursor-pointer"
    @click="eliminarVacante"
    >Eliminar</a
  >
</template>

<script>
export default {
  props: {
    vacanteId: {
      type: String,
      required: true,
    },
  },

  data() {
    return {};
  },

  methods: {
    eliminarVacante() {
      this.$swal
        .fire({
          title: "¿Estas Seguro?",
          text: "No podras revertir esto",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, Estoy seguro!",
          cancelButtonText: "Cancelar",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .post(`/vacantes/${this.vacanteId}`, {
                _method: "delete",
              })
              .then((res) => {
                this.$swal.fire("Eliminado!", `${res.data.mensaje}`, "success");

                // eliminar vacante del DOM
                this.$el.parentElement.parentElement.parentElement.removeChild(
                  this.$el.parentElement.parentElement
                );
              })
              .catch((error) => console.log(error));
          }
        });
    },
  },
};
</script>