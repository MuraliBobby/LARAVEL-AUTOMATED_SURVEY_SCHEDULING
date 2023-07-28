<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Survey Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 shadow-md rounded-md w-96">
            <h1 class="text-2xl font-semibold mb-6">User Survey Form</h1>
            <form action="{{route('details.store')}}" method="post">
                @csrf
                <!-- User Availability Details - From Time -->
                <div class="mb-4">
                    <label for="from_time" class="block font-medium mb-2">From Time</label>
                    <input type="time" name="from_time" id="from_time" required placeholder="HH:MM AM/PM" class="w-full px-4 py-2 rounded-md border focus:outline-none focus:ring focus:border-blue-300">
                </div>

                <!-- User Availability Details - To Time -->
                <div class="mb-4">
                    <label for="to_time" class="block font-medium mb-2">To Time</label>
                    <input type="time" name="to_time" id="to_time" required placeholder="HH:MM AM/PM" class="w-full px-4 py-2 rounded-md border focus:outline-none focus:ring focus:border-blue-300">
                </div>

                <!-- User Preferences -->
                <div class="mb-4">
                    <label class="block font-medium mb-2">Preferences</label>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="preferences[]" value="Technology" class="form-checkbox">
                            <span class="ml-2">Technology</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="preferences[]" value="Health" class="form-checkbox">
                            <span class="ml-2">Health</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="preferences[]" value="Food" class="form-checkbox">
                            <span class="ml-2">Food</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="preferences[]" value="Travel" class="form-checkbox">
                            <span class="ml-2">Travel</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="preferences[]" value="Sports" class="form-checkbox">
                            <span class="ml-2">Sports</span>
                        </label>
                        <!-- Add more preferences as needed -->
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
