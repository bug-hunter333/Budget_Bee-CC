import 'package:flutter/material.dart';

class CustomBottomNavBar extends StatelessWidget {
  final int selectedIndex;
  final Function(int) onItemTapped;

  const CustomBottomNavBar({
    super.key,
    required this.selectedIndex,
    required this.onItemTapped,
  });

  @override
  Widget build(BuildContext context) {
    return BottomAppBar(
      shape: const CircularNotchedRectangle(),
      notchMargin: 10,
      height: 70,
      color: Colors.white,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        children: [
          IconButton(
            icon: const Icon(Icons.home, size: 30),
            color: selectedIndex == 0 ? Colors.green : Colors.grey,
            onPressed: () => onItemTapped(0),
          ),
          IconButton(
            icon: const Icon(Icons.bar_chart, size: 30),
            color: selectedIndex == 1 ? Colors.green : Colors.grey,
            onPressed: () => onItemTapped(1),
          ),
          const SizedBox(width: 40),
          IconButton(
            icon: const Icon(Icons.credit_card, size: 30),
            color: selectedIndex == 2 ? Colors.green : Colors.grey,
            onPressed: () => onItemTapped(2),
          ),
          IconButton(
            icon: const Icon(Icons.person_outline, size: 30),
            color: selectedIndex == 3 ? Colors.green : Colors.grey,
            onPressed: () => onItemTapped(3),
          ),
        ],
      ),
    );
  }
}
