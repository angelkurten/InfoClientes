<script>
    import { Pie } from 'vue-chartjs'
    export default {
        extends: Pie,
        mounted () {
            this.getCities();
        },

        methods:{
            getCities(){
                axios.get('/api/cities').then((response) => {
                    var cities = [];
                    var visits = [];
                    var color = [];
                    jQuery.each(response.data, function () {
                        cities.push(this.name);
                        visits.push(this.visits_count);
                        color.push(getRandomColor())
                    });

                    this.renderChart({
                            labels: cities,
                            datasets: [
                                {
                                    label: 'Data One',
                                    backgroundColor: color,
                                    data: visits
                                }
                            ]},
                        {
                            responsive: true
                        }
                    )
                });
                function getRandomColor(){
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }
            },
        }
    }
</script>
