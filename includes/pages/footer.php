</div>
        </div>
    </div>
    
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('#dataTable tbody tr');

            rows.forEach(function(row) {
                var cells = row.querySelectorAll('td');
                var match = false;

                cells.forEach(function(cell) {
                    if (cell.textContent.toLowerCase().indexOf(input) > -1) {
                        match = true;
                    }
                });

                if (match) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        function toggleMenu() {
            var menu = document.querySelector('nav');
            menu.classList.toggle('active');
        }
    </script>
</body>
</html>