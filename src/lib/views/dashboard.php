<!doctype html>
<html lang="en">
  <head>
    <title>Dashboard example</title>
  </head>
  
  <body>
    <input id="beginDate" type="datetime-local" name="begin-date" />
    <input id="endDate" type="datetime-local" name="end-date" />
    <div><canvas id="myChart"></canvas></div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            intergrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"
            integrity="sha512-CQBWl4fJHWbryGE+Pc7UAxWMUMNMWzWxF4SQo9CgkJIN1kx6djDQZjh3Y8SZ1d+6I+1zze6Z7kHXO7q3UyZAWw==" 
            crossorigin="anonymous"
            referrerpolicy="no-referrer">
    </script>
    <script  src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3.0.0/dist/chartjs-adapter-date-fns.bundle.min.js"
             integrity="sha256-6nqzDSbDjc8fLSa7Q+c6lFN7WPGQb1XhpUbdCTIbVhU="
             crossorigin="anonymous">
    </script> 
    <script src="/scripts/render-graph.js"></script>
  </body>
</html>
