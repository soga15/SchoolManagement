<template>
  <v-container>
    <v-carousel hide-delimiters>
      <v-carousel-item
        v-for="(item,i) in items"
        :key="i"
        :src="item.src"
      ></v-carousel-item>
    </v-carousel>
  </v-container>
</template>  

<script>
  export default {
    data: () => ({
       items: [
          {
            src: 'aws.png',
          },
          {
            src: 'awe.png',
          },
          {
            src: 'awer.png',
          },
          {
            src: 'awert.png',
          },      
        ],
      
    }),
  }
</script>

