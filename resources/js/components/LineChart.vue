<script>
    import {Line} from 'vue-chartjs'

    export default {
        extends: Line,
        props: ['visits'],
        data() {
            return {}
        },
        mounted() {
            var color = [];
            var label = [];
            var value_visits = [];
            self = this;
            jQuery.each(this.visits, function () {
                label.push(this.visit_at);
                value_visits.push(this.value_visit);
                color.push(self.getRandomColor());
            });

            this.renderChart({
                    labels: label,
                    datasets: [
                        {
                            label: 'Movimiento',
                            backgroundColor: color,
                            data: value_visits
                        }
                    ]
                },
                {
                    responsive: true
                }
            )
        },

        methods: {
            getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

        }
    }
</script>
