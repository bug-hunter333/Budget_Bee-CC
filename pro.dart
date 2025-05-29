import 'package:flutter/material.dart';
import 'package:firebase_auth/firebase_auth.dart';
import 'login.dart'; // Ensure this page exists
import 'home_page.dart';
import 'analytics_page.dart';
import 'wallet_page.dart';
import 'custom_bottom_nav.dart'; // Ensure you have this file

class pro extends StatefulWidget {
  const pro({super.key});

  @override
  State<pro> createState() => _ProState();
}

class _ProState extends State<pro> {
  final User? user = FirebaseAuth.instance.currentUser;
  int _selectedIndex = 3;

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
              case 2:
                return const WalletPage();
              case 3:
              default:
                return const pro();
            }
          },
        ),
      );
    }
  }

  Future<void> _signUserOut() async {
    try {
      await FirebaseAuth.instance.signOut();

      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Signed out successfully')),
        );
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(builder: (_) => LoginPage()),
        );
      }
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Error signing out: ${e.toString()}')),
      );
    }
  }

  String _getUserDisplayName() {
    if (user?.displayName != null && user!.displayName!.isNotEmpty) {
      return user!.displayName!;
    } else if (user?.email != null) {
      return user!.email!.split('@')[0];
    }
    return 'Unknown User';
  }

  String _getUserHandle() {
    if (user?.email != null) {
      return '@${user!.email!.split('@')[0]}';
    }
    return '@unknown';
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF4F6F8),
      body: SafeArea(
        child: ListView(
          children: [
            _buildHeader(),
            const SizedBox(height: 20),
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 20),
              child: Column(
                children: [
                  _buildUserSummary(),
                  const SizedBox(height: 20),
                  ElevatedButton.icon(
                    onPressed: _signUserOut,
                    icon: const Icon(Icons.logout),
                    label: const Text("Sign Out"),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.red,
                      foregroundColor: Colors.white,
                      padding: const EdgeInsets.symmetric(
                          horizontal: 24, vertical: 12),
                    ),
                  ),
                  const SizedBox(height: 80), // Space for FAB and nav bar
                ],
              ),
            ),
          ],
        ),
      ),
      floatingActionButton: FloatingActionButton(
        backgroundColor: const Color(0xFF1E5A50),
        child: const Icon(Icons.add, color: Colors.white),
        onPressed: () {
          // Add your action here
        },
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
      bottomNavigationBar: CustomBottomNavBar(
        selectedIndex: _selectedIndex,
        onItemTapped: _onItemTapped,
      ),
    );
  }

  Widget _buildHeader() {
    return Container(
      height: 220,
      width: double.infinity,
      decoration: const BoxDecoration(
        color: Color(0xFF1E5A50),
        borderRadius: BorderRadius.only(
          bottomLeft: Radius.circular(30),
          bottomRight: Radius.circular(30),
        ),
      ),
      child: Center(
        child: Padding(
          padding: const EdgeInsets.only(top: 50),
          child: Column(
            children: [
              CircleAvatar(
                radius: 40,
                backgroundColor: Colors.white,
                backgroundImage: user?.photoURL != null
                    ? NetworkImage(user!.photoURL!)
                    : null,
                child: user?.photoURL == null
                    ? const Icon(Icons.person,
                        size: 40, color: Color(0xFF2AB573))
                    : null,
              ),
              const SizedBox(height: 10),
              Text(
                _getUserDisplayName(),
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                ),
              ),
              Text(
                _getUserHandle(),
                style: const TextStyle(color: Colors.white70),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildUserSummary() {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.teal.shade50,
        borderRadius: BorderRadius.circular(15),
        border: Border.all(color: Colors.teal.shade100),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text("Account Info",
              style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
          const SizedBox(height: 10),
          Row(
            children: [
              const Icon(Icons.email, color: Colors.teal),
              const SizedBox(width: 10),
              Text(user?.email ?? 'No email found'),
            ],
          ),
          const SizedBox(height: 10),
          Row(
            children: [
              Icon(
                user?.emailVerified == true
                    ? Icons.check_circle
                    : Icons.warning,
                color:
                    user?.emailVerified == true ? Colors.green : Colors.orange,
              ),
              const SizedBox(width: 10),
              Text(
                user?.emailVerified == true
                    ? "Email Verified"
                    : "Email Not Verified",
                style: TextStyle(
                  color: user?.emailVerified == true
                      ? Colors.green
                      : Colors.orange,
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }
}
