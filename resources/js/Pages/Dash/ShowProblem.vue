<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Show</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>catégorie</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>email</th>
                            <th>Localité</th>
                            <th>pop touchée</th>
                            <th>téléphone</th>
                            <th>détails</th>
                        </tr>

                        <tr v-for="contact in contacts" :key="contact.id">
                            <td>{{ contact.category }}</td>
                            <td>{{ contact.lastName }}</td>
                            <td>{{ contact.firstName }}</td>
                            <td>{{ contact.email }}</td>
                            <td>{{ contact.locality }}</td>
                            <td>{{ contact.population }}</td>
                            <td>{{ contact.phone }}</td>
                            <td>{{ contact.details }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div style="width:70%; heigth: 100px;">
                <l-map style="height: 350px" :zoom="zoom" :center="center">
                    <l-tile-layer :url="url"></l-tile-layer>

                    <div>
                        <l-marker :lat-lng="[data.data[0].geojson.coordinates[1], data.data[0].geojson.coordinates[0]]">
                            <l-tooltip :options="{ permanent: true, interactive: true }">
                                I am a tooltip
                            </l-tooltip>
                        </l-marker>

                    </div>
                </l-map>
            </div>
        </div>
        {{ newArea }} <br><br>
        {{ data }}
    </div>
</div>
</template>

<script>
import {
    LMap,
    LTileLayer,
    LMarker,
    LTooltip
} from 'vue2-leaflet';
export default {
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LTooltip
    },
    data() {
        return {
            url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            zoom: 6,
            center: [15.313220, -10.319482],
            data: {},
            newArea: {},
        };
    },
    props: [
        'contacts', 'areas'
    ],
    mounted: function () {
        this.newArea = this.areas;
        for (var i = 0; i <= this.newArea.length - 1; i++) {
            axios.get(`https://nominatim.openstreetmap.org/search.php?q=${this.newArea[i].area}&polygon_geojson=1&format=jsonv2`)
                .then(response => (this.data = response))
                .then(this.setResults);
        }

    },
    methods: {
        setResults(results) {
            this.data = results;
        },
    }
}
</script>
