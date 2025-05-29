import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'home_page.dart'; // Ensure this import points to your actual HomePage

class BankIntegrationPage extends StatefulWidget {
  const BankIntegrationPage({super.key});

  @override
  State<BankIntegrationPage> createState() => _BankIntegrationPageState();
}

class _BankIntegrationPageState extends State<BankIntegrationPage> {
  List<Map<String, dynamic>> _banks = [
    {
      "name": "HNB Bank",
      "logo": FontAwesomeIcons.buildingColumns,
      "connected": true,
      "accountType": "Savings",
      "details": "IBAN: LK01HNBX0000000001\nBranch: Colombo 07"
    },
    {
      "name": "BOC Bank",
      "logo": FontAwesomeIcons.piggyBank,
      "connected": false,
      "accountType": "Checking",
      "details": "IBAN: LK02BOCX0000000002\nBranch: Nugegoda"
    },
    {
      "name": "Commercial Bank",
      "logo": FontAwesomeIcons.landmark,
      "connected": true,
      "accountType": "Savings",
      "details": "IBAN: LK03COMX0000000003\nBranch: Kandy"
    },
  ];

  String _selectedFilter = 'All';

  void _showConnectModal(Map<String, dynamic> bank, int index) {
    showModalBottomSheet(
      context: context,
      shape: const RoundedRectangleBorder(
          borderRadius: BorderRadius.vertical(top: Radius.circular(20))),
      builder: (context) => Padding(
        padding: const EdgeInsets.all(20),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Text('Connect to ${bank['name']}',
                style:
                    const TextStyle(fontWeight: FontWeight.bold, fontSize: 18)),
            const SizedBox(height: 10),
            const TextField(
              decoration: InputDecoration(
                labelText: 'Account Number',
                border: OutlineInputBorder(),
              ),
            ),
            const SizedBox(height: 10),
            const TextField(
              obscureText: true,
              decoration: InputDecoration(
                labelText: 'PIN',
                border: OutlineInputBorder(),
              ),
            ),
            const SizedBox(height: 20),
            ElevatedButton.icon(
              onPressed: () {
                Navigator.pop(context);
                setState(() => _banks[index]['connected'] = true);
                ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                  content: Text('${bank['name']} connected successfully.'),
                  backgroundColor: Colors.green,
                ));
              },
              icon: const Icon(Icons.link),
              label: const Text('Connect Now'),
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFF1E5A50),
              ),
            )
          ],
        ),
      ),
    );
  }

  List<Map<String, dynamic>> get _filteredBanks {
    if (_selectedFilter == 'All') return _banks;
    return _banks
        .where((b) => b['connected'] == (_selectedFilter == 'Connected'))
        .toList();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF4F6F8),
      appBar: AppBar(
        backgroundColor: const Color(0xFF1E5A50),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.white),
          onPressed: () {
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (_) => const HomePage()),
            );
          },
        ),
        title: const Text(
          "Bank Integrations",
          style: TextStyle(
            color: Colors.white, // Set title text color to white
            fontWeight: FontWeight.bold,
          ),
        ),
        centerTitle: true,
        iconTheme:
            const IconThemeData(color: Colors.white), // Ensures icons are white
      ),
      body: Column(
        children: [
          _buildFilterBar(),
          Expanded(
            child: ListView.builder(
              padding: const EdgeInsets.all(16),
              itemCount: _filteredBanks.length,
              itemBuilder: (context, index) {
                final bank = _filteredBanks[index];
                return _buildBankCard(bank, index);
              },
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildFilterBar() {
    final filters = ['All', 'Connected', 'Not Connected'];
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 10, horizontal: 16),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        children: filters.map((filter) {
          final bool selected = _selectedFilter == filter;
          return ChoiceChip(
            label: Text(filter),
            selected: selected,
            onSelected: (_) => setState(() => _selectedFilter = filter),
            selectedColor: const Color(0xFF1E5A50),
            backgroundColor: Colors.grey[200],
            labelStyle: TextStyle(
              color: selected ? Colors.white : Colors.black,
            ),
          );
        }).toList(),
      ),
    );
  }

  Widget _buildBankCard(Map<String, dynamic> bank, int index) {
    return ExpansionTile(
      tilePadding: const EdgeInsets.symmetric(horizontal: 16),
      backgroundColor: Colors.white,
      collapsedBackgroundColor: Colors.white,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
      collapsedShape:
          RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
      title: Row(
        children: [
          CircleAvatar(
            backgroundColor: const Color(0xFFE0F2F1),
            child: FaIcon(bank['logo'], color: Colors.teal),
          ),
          const SizedBox(width: 12),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(bank['name'],
                    style: const TextStyle(
                        fontWeight: FontWeight.bold, fontSize: 16)),
                Text(bank['accountType'],
                    style: const TextStyle(color: Colors.grey)),
              ],
            ),
          ),
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
            decoration: BoxDecoration(
              color: bank['connected']
                  ? Colors.green.shade100
                  : Colors.grey.shade300,
              borderRadius: BorderRadius.circular(20),
            ),
            child: Text(
              bank['connected'] ? "Connected" : "Not Connected",
              style: TextStyle(
                color:
                    bank['connected'] ? Colors.green.shade700 : Colors.black45,
                fontWeight: FontWeight.w500,
              ),
            ),
          ),
        ],
      ),
      children: [
        Padding(
          padding: const EdgeInsets.fromLTRB(16, 0, 16, 16),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(bank['details'] ?? '',
                  style: const TextStyle(fontSize: 14, color: Colors.black87)),
              const SizedBox(height: 10),
              Row(
                children: [
                  Expanded(
                    child: OutlinedButton.icon(
                      onPressed: bank['connected']
                          ? () {
                              setState(() => bank['connected'] = false);
                              ScaffoldMessenger.of(context).showSnackBar(
                                  SnackBar(
                                      content: Text(
                                          '${bank['name']} disconnected.')));
                            }
                          : () => _showConnectModal(bank, index),
                      icon: Icon(
                        bank['connected'] ? Icons.link_off : Icons.link,
                        size: 18,
                      ),
                      label: Text(bank['connected'] ? "Disconnect" : "Connect"),
                      style: OutlinedButton.styleFrom(
                        foregroundColor: bank['connected']
                            ? Colors.red
                            : const Color(0xFF1E5A50),
                        side: BorderSide(
                            color: bank['connected']
                                ? Colors.red
                                : const Color(0xFF1E5A50)),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(20),
                        ),
                      ),
                    ),
                  ),
                ],
              )
            ],
          ),
        ),
      ],
    );
  }
}
