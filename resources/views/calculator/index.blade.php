@php
    use App\Enums\CalculationMethodsEnum;
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>Calculator</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1,
        h2,
        h3 {
            color: #2c3e50;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin-bottom: 20px;
        }

        .error-messages {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ef9a9a;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .error-messages ul {
            margin: 0;
            padding-left: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="number"],
        select {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="number"]:focus,
        select:focus {
            border-color: #77aaff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(119, 170, 255, 0.25);
        }

        button[type="submit"] {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #2980b9;
        }

        .result {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
            text-align: center;
            font-size: 1.2em;
        }

        .history-list {
            list-style-type: none;
            padding: 0;
        }

        .history-list li {
            background-color: #ecf0f1;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 8px;
            font-size: 0.95em;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Calculator</h1>

        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('calculator.calculate') }}">
            @csrf

            <input type="number" step="any" name="a" placeholder="First number" required
                value="{{ old('a') }}">
            <input type="number" step="any" name="b" placeholder="Second number" required
                value="{{ old('b') }}">

            <select name="operation" required>
                @foreach (CalculationMethodsEnum::cases() as $operation)
                    <option value="{{ $operation->value }}"
                        {{ old('operation') == $operation->value ? 'selected' : '' }}>
                        {{ CalculationMethodsEnum::getLabel($operation->value) }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Calculate</button>
        </form>

        @if (session('result'))
            <div class="result">
                <h2>Result: {{ session('result') }}</h2>
            </div>
        @endif
    </div>

    @if ($history->isNotEmpty())
        <div class="container">
            <h3>Recent Calculations</h3>
            <ul class="history-list">
                @foreach ($history as $item)
                    <li>{{ $item->first_operand }} {{ $item->operation->sign() }} {{ $item->second_operand }} =
                        {{ $item->result }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>

</html>
