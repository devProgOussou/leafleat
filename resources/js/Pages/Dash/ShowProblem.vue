<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">Show</div>
          <div class="card-body"></div>
        </div>
      </div>
      <div class="col-md-12">
        <div style="width: 70%; heigth: 100px" v-if="datas[0] != undefined">
          {{ datas[0].display_name }}
          <l-map style="height: 350px" :zoom="zoom" :center="center">
            <l-tile-layer :url="url"></l-tile-layer>

            <div>
              <l-marker :lat-lng="[datas[0].lat, datas[0].lon]"></l-marker>
            </div>
          </l-map>
          {{ newData }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { LMap, LTileLayer, LMarker, LTooltip } from "vue2-leaflet";
export default {
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LTooltip,
  },
  data() {
    return {
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      zoom: 6,
      center: [15.31322, -10.319482],
      datas: {},
      newArea: {},
      length: null,
      results: {},
      newData: [],
    };
  },
  props: ["contacts", "areas"],
  mounted: function () {
    this.newArea = this.areas;

    for (var i = 0; i <= this.newArea.length - 1; i++) {
      var url = this.newArea[i].area;
      var newData = new Array(this.newArea.length - 1);
      axios
        .get(
          `https://nominatim.openstreetmap.org/search.php?q=${url}&polygon_geojson=1&format=jsonv2`
        )
        .then((response) => (this.datas = response.data))
        .then((this.newData = [...newData].push(this.datas)))
        .then(console.log(this.datas));
    }
  },
  methods: {
    setResults(results) {
      this.datas = results;
    },
  },
};
</script>
