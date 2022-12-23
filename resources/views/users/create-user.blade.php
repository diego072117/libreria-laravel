<x-app>
    <section class="container my-5">
        <div class="card">

            <div class="card-header">
            <h2>Crear Usuario</h2>
            </div>

            <div class="card-body">

                <form action="{{route('user.create.post')}}" method="POST">
                    @csrf
                    <x-user.form-user :roles="$roles"/>
                </form>

            </div>
        </div>
    </section>
</x-app>