import 'package:flutter/material.dart';
import 'package:pie_chart/pie_chart.dart';
import 'custom_bottom_nav.dart';
import 'home_page.dart';
import 'wallet_page.dart';
import 'pro.dart';

class AnalyticsPage extends StatefulWidget {
  const AnalyticsPage({super.key});

  @override
  State<AnalyticsPage> createState() => _AnalyticsPageState();
}

class _AnalyticsPageState extends State<AnalyticsPage> {
  int _selectedIndex = 1;
  double _monthlyIncome = 100000.0;
  double _spendingAmount = 70000.0;
  double _savingAmount = 30000.0;

  List<Map<String, dynamic>> _expenses = [
    {"name": "Groceries", "amount": 5000.0, "category": "Food"},
    {"name": "Bus Pass", "amount": 2000.0, "category": "Transport"},
    {"name": "Electric Bill", "amount": 3000.0, "category": "Electricity"},
    {"name": "Movie Night", "amount": 1500.0, "category": "Entertainment"},
  ];

  Map<String, double> categoryData = {
    "Food": 28000,
    "Electricity": 10500,
    "Transport": 10500,
    "Entertainment": 7000,
    "Others": 14000,
  };

  void _onItemTapped(int index) {
    if (index != _selectedIndex) {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(
          builder: (context) {
            switch (index) {
              case 0:
                return const HomePage();
              case 2:
                return const WalletPage();
              case 3:
                return pro();
              default:
                return const HomePage();
            }
          },
        ),
      );
    }
  }

  void _showAddExpenseDialog() {
    final TextEditingController nameController = TextEditingController();
    final TextEditingController amountController = TextEditingController();
    String selectedCategory = 'Food';

    showDialog(
      context: context,
      builder: (context) {
        return AlertDialog(
          title: const Text('Add Expense'),
          content: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              TextField(
                controller: nameController,
                decoration: const InputDecoration(labelText: 'Expense Name'),
              ),
              TextField(
                controller: amountController,
                keyboardType: TextInputType.number,
                decoration: const InputDecoration(labelText: 'Amount'),
              ),
              DropdownButton<String>(
                value: selectedCategory,
                isExpanded: true,
                items: categoryData.keys
                    .map((cat) => DropdownMenuItem(
                          value: cat,
                          child: Text(cat),
                        ))
                    .toList(),
                onChanged: (val) {
                  if (val != null) {
                    setState(() => selectedCategory = val);
                  }
                },
              )
            ],
          ),
          actions: [
            TextButton(
              onPressed: () => Navigator.of(context).pop(),
              child: const Text('Cancel'),
            ),
            ElevatedButton(
              onPressed: () {
                if (nameController.text.isNotEmpty &&
                    double.tryParse(amountController.text) != null) {
                  double amount = double.parse(amountController.text);

                  setState(() {
                    _expenses.add({
                      "name": nameController.text,
                      "amount": amount,
                      "category": selectedCategory,
                    });

                    _spendingAmount += amount;
                    _savingAmount = _monthlyIncome - _spendingAmount;
                    categoryData[selectedCategory] =
                        (categoryData[selectedCategory] ?? 0) + amount;
                  });
                  Navigator.of(context).pop();
                }
              },
              child: const Text('Add'),
            ),
          ],
        );
      },
    );
  }

        @override
        Widget build(BuildContext context) {
          return Scaffold(
            backgroundColor: const Color(0xFFF4F6F8),
            appBar: AppBar(
            backgroundColor: const Color(0xFF1E5A50),
            centerTitle: true,
            title: const Text(
              'Budget Analytics',
              style: TextStyle(
                color: Colors.white, // Set the text color to white
                fontWeight: FontWeight.bold,
              ),
            ),
            actions: [
              IconButton(
                icon: const Icon(Icons.add, color: Colors.white),
                onPressed: _showAddExpenseDialog,
              ),
            ],
          ),

      body: SingleChildScrollView(
        padding: const EdgeInsets.all(20),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Center(
              child: Column(
                children: [
                  const Text('Monthly Income',
                      style: TextStyle(color: Colors.grey, fontSize: 16)),
                  const SizedBox(height: 5),
                  Text(
                    'Rs ${_monthlyIncome.toStringAsFixed(2)}',
                    style: const TextStyle(
                        fontSize: 28, fontWeight: FontWeight.bold),
                  ),
                ],
              ),
            ),
            const SizedBox(height: 30),
            _buildSummaryTile('Spending Amount', _spendingAmount, Colors.red),
            _buildSummaryTile('Saving Amount', _savingAmount, Colors.green),
            const SizedBox(height: 30),
            const Text('Spending by Categories',
                style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
            const SizedBox(height: 15),
            PieChart(
              dataMap: categoryData,
              animationDuration: const Duration(milliseconds: 800),
              chartRadius: MediaQuery.of(context).size.width / 2,
              chartType: ChartType.disc,
              ringStrokeWidth: 32,
              legendOptions: const LegendOptions(
                showLegends: true,
                legendPosition: LegendPosition.right,
              ),
            ),
            const SizedBox(height: 30),
            const Divider(),
            const Text('Expense List',
                style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
            const SizedBox(height: 10),
            ..._expenses.map((e) => ListTile(
                  leading: const Icon(Icons.remove_circle_outline,
                      color: Colors.red),
                  title: Text(e["name"]),
                  subtitle: Text("Category: ${e["category"]}"),
                  trailing: Text(
                    'Rs ${e["amount"].toStringAsFixed(2)}',
                    style: const TextStyle(fontWeight: FontWeight.bold),
                  ),
                )),
          ],
        ),
      ),
      bottomNavigationBar: CustomBottomNavBar(
        selectedIndex: _selectedIndex,
        onItemTapped: _onItemTapped,
      ),
    );
  }

  Widget _buildSummaryTile(String title, double amount, Color color) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(title, style: TextStyle(color: Colors.grey[700], fontSize: 16)),
        const SizedBox(height: 5),
        Text(
          'Rs ${amount.toStringAsFixed(2)}',
          style: TextStyle(
              fontSize: 24, fontWeight: FontWeight.bold, color: color),
        ),
        const SizedBox(height: 20),
      ],
    );
  }
}
