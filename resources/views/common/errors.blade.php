@if (count($errors) > 0) 
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <strong>Whoops! Something went wrong!</strong>

        <br><br>

        <ul>            
            @foreach ($errors->all() as $error)
                <li>{{ error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- $errors is available in every View -->
<!-- It will simply be an empty instance of ViewErrorBag if no validation errors are present. -->
