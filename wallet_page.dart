import 'package:flutter/material.dart';
import 'package:pie_chart/pie_chart.dart';

import 'analytics_page.dart';
import 'custom_bottom_nav.dart';
import 'home_page.dart';
import 'pro.dart';

class WalletPage extends StatefulWidget {
  const WalletPage({super.key});

  @override
  State<WalletPage> createState() => _WalletPageState();
}

class _WalletPageState extends State<WalletPage> {
  int _selectedIndex = 2;

  List<Map<String, dynamic>> _transactions = [
    {"title": "Netflix", "amount": 1500.0, "category": "Entertainment"},
    {"title": "Grocery", "amount": 4500.0, "category": "Food"},
    {"title": "Bus Ticket", "amount": 1000.0, "category": "Transport"},
    {"title": "Electric Bill", "amount": 3000.0, "category": "Electricity"},
  ];

  final Map<String, double> _categoryTotals = {
    "Food": 4500.0,
    "Electricity": 3000.0,
    "Transport": 1000.0,
    "Entertainment": 1500.0,
  };

  double get _totalBalance {
    return _transactions.fold(0.0, (sum, item) => sum + item['amount']);
  }

  void _onItemTapped(int index) {
    if (index != _selectedIndex) {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(
          builder: (context) {
            switch (index) {
              case 0:
                return const HomePage();
              case 1:
                return const AnalyticsPage();
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

  void _showAddTransactionDialog() {
    final TextEditingController nameController = TextEditingController();
    final TextEditingController amountController = TextEditingController();
    String selectedCategory = 'Food';

    showDialog(
      context: context,
      builder: (context) {
        return AlertDialog(
          title: const Text('Add Transaction'),
          content: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              TextField(
                controller: nameController,
                decoration: const InputDecoration(labelText: 'Title'),
              ),
              TextField(
                controller: amountController,
                keyboardType: TextInputType.number,
                decoration: const InputDecoration(labelText: 'Amount'),
              ),
              DropdownButton<String>(
                value: selectedCategory,
                isExpanded: true,
                items: _categoryTotals.keys
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
                final name = nameController.text;
                final amount = double.tryParse(amountController.text);
                if (name.isNotEmpty && amount != null) {
                  setState(() {
                    _transactions.add({
                      "title": name,
                      "amount": amount,
                      "category": selectedCategory,
                    });
                    _categoryTotals[selectedCategory] =
                        (_categoryTotals[selectedCategory] ?? 0) + amount;
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
      backgroundColor: const Color(0xFF00796B),
      body: SafeArea(
        child: Column(
          children: [
            const SizedBox(height: 20),
            _buildTopBar(),
            const SizedBox(height: 20),
            Expanded(
              child: Container(
                padding: const EdgeInsets.all(20),
                decoration: const BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.vertical(top: Radius.circular(30)),
                ),
                child: SingleChildScrollView(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Center(
                        child: Column(
                          children: [
                            const Text(
                              "Total Balance",
                              style: TextStyle(
                                fontSize: 16,
                                color: Colors.grey,
                              ),
                            ),
                            const SizedBox(height: 5),
                            Text(
                              "Rs ${_totalBalance.toStringAsFixed(2)}",
                              style: const TextStyle(
                                fontSize: 28,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                          ],
                        ),
                      ),
                      const SizedBox(height: 20),
                      _buildActionsRow(),
                      const SizedBox(height: 20),
                      const Text(
                        "Spending by Category",
                        style: TextStyle(
                            fontSize: 18, fontWeight: FontWeight.bold),
                      ),
                      const SizedBox(height: 10),
                      PieChart(
                        dataMap: _categoryTotals,
                        chartRadius: MediaQuery.of(context).size.width / 2,
                        animationDuration: const Duration(milliseconds: 800),
                        chartType: ChartType.disc,
                        ringStrokeWidth: 30,
                        legendOptions: const LegendOptions(
                          showLegends: true,
                          legendPosition: LegendPosition.right,
                        ),
                      ),
                      const SizedBox(height: 30),
                      const Text(
                        "Transactions",
                        style: TextStyle(
                            fontSize: 18, fontWeight: FontWeight.bold),
                      ),
                      const SizedBox(height: 10),
                      ..._transactions.map((tx) => ListTile(
                            leading: const Icon(Icons.swap_horiz_rounded,
                                color: Colors.teal),
                            title: Text(tx['title']),
                            subtitle: Text(tx['category']),
                            trailing: Text(
                              'Rs ${tx['amount'].toStringAsFixed(2)}',
                              style:
                                  const TextStyle(fontWeight: FontWeight.bold),
                            ),
                          )),
                    ],
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: _showAddTransactionDialog,
        backgroundColor: const Color.fromARGB(255, 209, 214, 213),
        child: const Icon(Icons.add),
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
      bottomNavigationBar: CustomBottomNavBar(
        selectedIndex: _selectedIndex,
        onItemTapped: _onItemTapped,
      ),
    );
  }

  Widget _buildTopBar() {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20),
      child: Row(
        children: [
          const Spacer(),
          const Text(
            'Wallet',
            style: TextStyle(fontSize: 20, color: Colors.white),
          ),
          const Spacer(),
          IconButton(
            icon: const Icon(Icons.notifications_none, color: Colors.white),
            onPressed: () {},
          ),
        ],
      ),
    );
  }

  Widget _buildActionsRow() {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceAround,
      children: const [
        _WalletAction(icon: Icons.account_balance_wallet, label: "Wallet"),
        _WalletAction(icon: Icons.qr_code, label: "Scan"),
        _WalletAction(icon: Icons.history, label: "History"),
      ],
    );
  }
}

class _WalletAction extends StatelessWidget {
  final IconData icon;
  final String label;

  const _WalletAction({required this.icon, required this.label});

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        CircleAvatar(
          radius: 24,
          backgroundColor: const Color(0xFFE0F2F1),
          child: Icon(icon, color: Colors.teal),
        ),
        const SizedBox(height: 5),
        Text(label),
      ],
    );
  }
}
