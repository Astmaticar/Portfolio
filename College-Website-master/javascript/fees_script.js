const artworks = [
  { id: 1, name: "Sunset Over Mountains", price: 20000, technique: "coal" },
  { id: 2, name: "Blooming Spring", price: 8000, technique: "aquarelle" },
  { id: 3, name: "Coal Study 2022", price: 12000, technique: "aquarelle" },
  { id: 4, name: "Mystic Forest", price: 15000, technique: "coal" },
  { id: 5, name: "Golden Horizon", price: 20000, technique: "aquarelle" },
  { id: 6, name: "Morning Dew", price: 8000, technique: "oil" },
  { id: 7, name: "Charcoal Sketch", price: 12000, technique: "oil" },
  { id: 8, name: "Evening Glow", price: 15000, technique: "coal" },
  { id: 9, name: "Ocean Breeze", price: 20000, technique: "oil" },
  { id: 10, name: "Sunlit Path", price: 8000, technique: "oil" },
  { id: 11, name: "Coal Study 2014", price: 12000, technique: "oil" },
  { id: 12, name: "Gentle River", price: 15000, technique: "aquarelle" },
  { id: 13, name: "Winter Calm", price: 20000, technique: "aquarelle" },
  { id: 14, name: "Autumn Leaves", price: 8000, technique: "oil" },
  { id: 15, name: "Coal Study 2010", price: 12000, technique: "oil" },
  { id: 16, name: "Misty Morning", price: 15000, technique: "oil" },
  { id: 17, name: "Sunset Glory", price: 20000, technique: "oil" },
  { id: 18, name: "Spring Fields", price: 8000, technique: "oil" },
  { id: 19, name: "Coal Study 2006", price: 12000, technique: "oil" },
  { id: 20, name: "Evening Mist", price: 15000, technique: "coal" },
  { id: 21, name: "Ocean Waves", price: 20000, technique: "oil" },
  { id: 22, name: "Morning Light", price: 8000, technique: "aquarelle" },
  { id: 23, name: "Coal Study 2002", price: 12000, technique: "aquarelle" },
  { id: 24, name: "Forest Walk", price: 15000, technique: "mixed" },
  { id: 25, name: "Sunrise Glory", price: 20000, technique: "oil" },
  { id: 26, name: "Aquarelle Study 1999", price: 8000, technique: "oil" },
  { id: 27, name: "Coal Study 1998", price: 12000, technique: "aquarelle" },
  { id: 28, name: "Mixed Media 1997", price: 15000, technique: "aquarelle" },
  { id: 29, name: "Sunset Fields 1996", price: 20000, technique: "aquarelle" },
  { id: 30, name: "Morning Mist 1995", price: 8000, technique: "aquarelle" },
  { id: 31, name: "Coal Sketch 1994", price: 12000, technique: "aquarelle" },
  { id: 32, name: "Mixed Study 1993", price: 15000, technique: "aquarelle" },
  { id: 33, name: "Final Coal Study 1992", price: 15000, technique: "coal" }
];



function getInputValue() {
  const technique = document.getElementById("course").value;
  const uid = parseInt(document.getElementById("uid").value);

  const art = artworks.find(a => a.id === uid && a.technique === technique);

  if(art){
    document.getElementById("demo").innerHTML = art.name;
    document.getElementById("demo1").innerHTML = art.price;
  } else {
    document.getElementById("demo").innerHTML = "No Records Found";
    document.getElementById("demo1").innerHTML = "0";
  }
}
