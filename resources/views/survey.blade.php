<!DOCTYPE html>
<html>
<head>
  <title>Fashion Interest Survey</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 20px;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
    }
    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    input[type="text"],
    input[type="email"],
    input[type="date"],
    textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    .radio-label {
      display: block;
      margin-bottom: 5px;
    }
    input[type="radio"] {
      margin-right: 5px;
    }
    .submit-btn {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .submit-btn:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Fashion Interest Survey</h1>
    <form>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="dob">Date of Birth:</label>
      <input type="date" id="dob" name="dob" required>

      <label>Gender:</label>
      <label class="radio-label">
        <input type="radio" name="gender" value="male" required>Male
      </label>
      <label class="radio-label">
        <input type="radio" name="gender" value="female" required>Female
      </label>
      <label class="radio-label">
        <input type="radio" name="gender" value="other" required>Other
      </label>

      <label for="fashionInterest">What aspects of fashion interest you the most? (Check all that apply):</label>
      <label class="checkbox-label">
        <input type="checkbox" name="fashionInterest" value="clothing">Clothing Trends
      </label>
      <label class="checkbox-label">
        <input type="checkbox" name="fashionInterest" value="accessories">Fashion Accessories
      </label>
      <label class="checkbox-label">
        <input type="checkbox" name="fashionInterest" value="footwear">Footwear Styles
      </label>
      <label class="checkbox-label">
        <input type="checkbox" name="fashionInterest" value="makeup">Makeup and Beauty
      </label>
      <label class="checkbox-label">
        <input type="checkbox" name="fashionInterest" value="hairstyles">Hairstyles and Haircare
      </label>
      <!-- Add more fashion interest options as needed -->

      <label>Describe your fashion style in a few words:</label>
      <input type="text" name="fashionStyle" required>

      <label for="fashionInfluencers">Who are your favorite fashion influencers or designers? (Optional):</label>
      <textarea id="fashionInfluencers" name="fashionInfluencers" rows="4"></textarea>

      <label>Where do you usually shop for fashion items? (Check all that apply):</label>
      <label class="checkbox-label">
        <input type="checkbox" name="shoppingPlaces" value="online">Online Stores
      </label>
      <label class="checkbox-label">
        <input type="checkbox" name="shoppingPlaces" value="localBoutiques">Local Boutiques
      </label>
      <label class="checkbox-label">
        <input type="checkbox" name="shoppingPlaces" value="departmentStores">Department Stores
      </label>
      <label class="checkbox-label">
        <input type="checkbox" name="shoppingPlaces" value="thriftStores">Thrift Stores
      </label>
      <!-- Add more shopping places options as needed -->

      <button type="submit" class="submit-btn">Submit</button>
    </form>
  </div>
</body>
</html>