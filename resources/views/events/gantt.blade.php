<x-app-layout>
    <div class="container mx-auto px-6 py-8 max-w-5xl">
        <h1 class="text-3xl font-bold mb-6">Gantt Chart for Event: {{ $event->title }}</h1>


     <div id="gantt" style="height: 800px;"></div>
    </div>

      <!--Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/frappe-gantt/dist/frappe-gantt.umd.js"></script>
    <!--Css-->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/frappe-gantt/dist/frappe-gantt.css">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tasks = {!! $tasksJson !!};
            const ganttElement = document.getElementById('gantt');

            new Gantt(ganttElement, tasks, {
                view_mode: 'Week',
                date_format: 'YYYY-MM-DD',
            });
        });
    </script>
</x-app-layout>
