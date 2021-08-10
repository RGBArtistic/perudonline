<template>
  <input type="button" value="envoyer" @click="testAxios">
  <div id="response"></div>
  <div>{{ dataget }}</div>
</template>

<script>
export default ({
  name: 'Login',
  data () {
    return {
      data: {
        table: 'test',
        nom: 'Axios',
        prenom: 'Vue',
        genre: 'f'
      },
      delete: {
        table: 'test',
        id: '12',
        _method: 'delete'
      },
      dataget: null
    }
  },
  methods: {
    deleteData () {
      this.axios.post('http://localhost/perudonline/src/php/use/delete.php', this.delete)
        .then((response) => { document.querySelector('#response').innerHTML = response.data })
    },
    createData () {
      this.axios.post('http://localhost/perudonline/src/php/use/post.php', this.data)
        .then((response) => { document.querySelector('#response').innerHTML = response.data })
    },
    putData () {
      this.axios.put('http://localhost/perudonline/src/php/use/update.php', this.data)
        .then((response) => { document.querySelector('#response').innerHTML = response.data })
    },
    testAxios () {
      this.axios.get('http://localhost/perudonline/src/php/use/get.php', this.data)
        .then((response) => (this.dataget = response))
    }
  }
})
</script>
